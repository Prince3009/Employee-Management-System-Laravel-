<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Task $task)
    {
        return $user->role->slug === 'super-admin' || 
               $user->role->slug === 'administrator' || 
               $task->assigned_to === $user->id;
    }

    public function create(User $user)
    {
        return $user->role->slug === 'super-admin' || 
               $user->role->slug === 'administrator';
    }

    public function update(User $user, Task $task)
    {
        return $user->role->slug === 'super-admin' || 
               $user->role->slug === 'administrator' || 
               $task->assigned_to === $user->id;
    }

    public function updateStatus(User $user, Task $task)
    {
        return $user->role->slug === 'super-admin' || 
               $user->role->slug === 'administrator' || 
               $task->assigned_to === $user->id;
    }

    public function delete(User $user, Task $task)
    {
        return $user->role->slug === 'super-admin' || 
               $user->role->slug === 'administrator';
    }
} 