<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tasks routes
    Route::prefix('/tasks')->group(function () {
        // Admin routes - must come before wildcard routes
        Route::middleware('role:admin')->group(function () {
            Route::get('/', [TaskController::class, 'indexAdmin'])->name('tasks.index-admin');
            Route::get('/create-form', [TaskController::class, 'createForm'])->name('tasks.create-form');
            Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
            Route::get('/{task}/edit', [TaskController::class, 'editForm'])->name('tasks.edit-form');
            Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
            Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        });

        // Editor routes
        Route::get('/list', [TaskController::class, 'listAssigned'])->name('tasks.list');
        Route::get('/{task}', [TaskController::class, 'showTask'])->name('tasks.show');
        Route::get('/{task}/submit-form', [TaskController::class, 'submitForm'])->name('tasks.submit-form');
        Route::post('/{task}/submit', [TaskController::class, 'submitTask'])->name('tasks.submit');
    });

    // Reviews - Reviewer routes
    Route::middleware('role:reviewer|permission:review-task')->group(function () {
        Route::prefix('/reviews')->group(function () {
            Route::get('/list', [ReviewController::class, 'listSubmissions'])->name('reviews.list');
            Route::get('/{submission}', [ReviewController::class, 'showSubmission'])->name('reviews.show');
            Route::get('/{submission}/approve-form', [ReviewController::class, 'approveForm'])->name('reviews.approve-form');
            Route::post('/{submission}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
            Route::get('/{submission}/reject-form', [ReviewController::class, 'rejectForm'])->name('reviews.reject-form');
            Route::post('/{submission}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
        });
    });

    // Users - Admin routes
    Route::middleware('role:admin|permission:view-users')->group(function () {
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'createForm'])->name('users.create-form');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/{user}/edit', [UserController::class, 'editForm'])->name('users.edit-form');
            Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });
        
        // Roles - Admin
        Route::resource('roles', \App\Http\Controllers\RoleController::class);
    });
});

