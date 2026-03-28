<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Admin routes
    public function indexAdmin()
    {
        $user = Auth::user();
        abort_unless($user instanceof User && $user->hasPermissionTo('view-tasks'), 403);
        
        $tasks = Task::with('assignedBy', 'assignedTo', 'submissions')
            ->orderBy('due_date', 'asc')
            ->get();

        return view('tasks.index-admin', ['tasks' => $tasks]);
    }

    public function createForm()
    {
        $user = Auth::user();
        abort_unless($user instanceof User && $user->hasPermissionTo('create-task'), 403);
        $editors = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['editor_3d', 'editor_animasi']);
        })->get();

        return view('tasks.create', ['editors' => $editors]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        abort_unless($user instanceof User && $user->hasPermissionTo('create-task'), 403);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to_id' => 'required|exists:users,id',
            'due_date' => 'required|date|after:today',
        ]);

        $validated['assigned_by_id'] = Auth::id();
        $validated['status'] = 'pending';

        Task::create($validated);

        return redirect()->route('tasks.index-admin')
            ->with('success', 'Tugas berhasil dibuat');
    }

    public function editForm(Task $task)
    {
        $user = Auth::user();
        abort_unless($user instanceof User && $user->hasPermissionTo('edit-task'), 403);
        
        $editors = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['editor_3d', 'editor_animasi']);
        })->get();

        return view('tasks.edit', ['task' => $task, 'editors' => $editors]);
    }

    public function update(Request $request, Task $task)
    {
        $user = Auth::user();
        abort_unless($user instanceof User && $user->hasPermissionTo('edit-task'), 403);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,submitted,approved,rejected',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index-admin')
            ->with('success', 'Tugas berhasil diperbarui');
    }

    public function destroy(Task $task)
    {
        $user = Auth::user();
        abort_unless($user instanceof User && $user->hasPermissionTo('delete-task'), 403);
        
        $task->delete();

        return redirect()->route('tasks.index-admin')
            ->with('success', 'Tugas berhasil dihapus');
    }

    // Editor routes
    public function listAssigned()
    {
        $user = Auth::user();
        $tasks = Task::where('assigned_to_id', $user->id)
            ->with('assignedBy', 'submissions')
            ->get();

        return view('tasks.list-assigned', ['tasks' => $tasks]);
    }

    public function showTask(Task $task)
    {
        $user = Auth::user();
        abort_unless($user instanceof User && ($user->id === $task->assigned_to_id || $user->hasRole('admin')), 403);
        
        return view('tasks.show', [
            'task' => $task->load('assignedBy', 'submissions'),
        ]);
    }

    public function submitForm(Task $task)
    {
        $user = Auth::user();
        abort_unless($user->id === $task->assigned_to_id, 403);
        
        return view('tasks.submit', ['task' => $task]);
    }

    public function submitTask(Request $request, Task $task)
    {
        $user = Auth::user();
        abort_unless($user->id === $task->assigned_to_id && $task->status !== 'submitted', 403);

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'drive_link' => 'required|url',
        ]);

        TaskSubmission::create([
            'task_id' => $task->id,
            'submitted_by_id' => Auth::id(),
            'notes' => $validated['notes'],
            'drive_link' => $validated['drive_link'],
            'status' => 'pending_review',
            'submitted_at' => now(),
        ]);

        $task->update(['status' => 'submitted']);

        return redirect()->route('tasks.list')
            ->with('success', 'Tugas berhasil disubmit untuk review');
    }

    // Public routes
    public function index()
    {
        $user = Auth::user();
        if ($user instanceof User && $user->hasRole('admin')) {
            $tasks = Task::with('assignedBy', 'assignedTo')->get();
        } else {
            $tasks = Task::where('assigned_to_id', $user->id)
                ->with('assignedBy', 'submissions')
                ->get();
        }

        return view('tasks.index', ['tasks' => $tasks]);
    }
}
