<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\PerformanceLog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user instanceof User || !$user->hasRole(['admin', 'editor_3d', 'editor_animasi', 'reviewer'])) {
            abort(403, 'Unauthorized access');
        }

        // For admin and reviewer
        if ($user->hasRole(['admin', 'reviewer'])) {
            return $this->adminDashboard();
        }

        // For editors
        return $this->editorDashboard();
    }

    private function adminDashboard()
    {
        $totalUsers = User::count();
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'approved')->count();

        // Get performance for each user this month
        $performanceData = User::where('email', '!=', 'admin@example.com')
            ->get()
            ->map(function ($user) {
                $thisMonth = now()->startOfMonth();
                
                $onTime = PerformanceLog::where('user_id', $user->id)
                    ->where('is_on_time', true)
                    ->whereDate('completed_at', '>=', $thisMonth)
                    ->count();

                $late = PerformanceLog::where('user_id', $user->id)
                    ->where('is_on_time', false)
                    ->whereDate('completed_at', '>=', $thisMonth)
                    ->count();

                $assignedTasks = Task::where('assigned_to_id', $user->id)
                    ->whereDate('created_at', '>=', $thisMonth)
                    ->count();

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'on_time' => $onTime,
                    'late' => $late,
                    'assigned_tasks' => $assignedTasks,
                    'completed_tasks' => $onTime + $late,
                ];
            });

        return view('dashboard.admin', [
            'totalUsers' => $totalUsers,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'performanceData' => $performanceData,
        ]);
    }

    private function editorDashboard()
    {
        $user = Auth::user();
        
        $assignedTasks = Task::where('assigned_to_id', $user->id)->count();
        $completedTasks = Task::where('assigned_to_id', $user->id)
            ->where('status', 'approved')
            ->count();
        $pendingTasks = Task::where('assigned_to_id', $user->id)
            ->whereIn('status', ['pending', 'in_progress'])
            ->count();

        // User's performance this month
        $thisMonth = now()->startOfMonth();
        $onTime = PerformanceLog::where('user_id', $user->id)
            ->where('is_on_time', true)
            ->whereDate('completed_at', '>=', $thisMonth)
            ->count();

        $late = PerformanceLog::where('user_id', $user->id)
            ->where('is_on_time', false)
            ->whereDate('completed_at', '>=', $thisMonth)
            ->count();

        return view('dashboard.editor', [
            'assignedTasks' => $assignedTasks,
            'completedTasks' => $completedTasks,
            'pendingTasks' => $pendingTasks,
            'onTime' => $onTime,
            'late' => $late,
        ]);
    }
}
