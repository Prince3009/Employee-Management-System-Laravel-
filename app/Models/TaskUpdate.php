<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskUpdate extends Model
{
    /**
     * Get the task that this update belongs to.
     */
    public function task()
    {
        return $this->belongsTo(Task::class); // Each TaskUpdate belongs to a Task
    }

    /**
     * Get the user who created this update.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Each TaskUpdate belongs to a User (creator)
    }
}

