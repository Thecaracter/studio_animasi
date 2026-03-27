<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', ['users' => $users]);
    }

    public function createForm()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',    
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('users.index')
            ->with('success', "User {$user->name} berhasil didaftarkan");       
    }

    public function editForm(User $user)
    {
        $allRoles = \Spatie\Permission\Models\Role::all();
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->first()?->name,
            'allRoles' => $allRoles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,        
            'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->syncRoles($validated['role']);

        return redirect()->route('users.index')
            ->with('success', "User {$user->name} berhasil diupdate");
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus user sendiri');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
