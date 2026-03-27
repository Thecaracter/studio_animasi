<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine if the user can view a task.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->assigned_to_id || $user->hasRole('admin');
    }

    /**
     * Determine if the user can update the task (submit it).
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->assigned_to_id && $task->status !== 'submitted';
    }

    /**
     * Determine if the user can create a task.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-task');
    }

    /**
     * Determine if the user can delete a task.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->hasPermissionTo('delete-task');
    }
}
