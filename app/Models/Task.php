<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'assigned_to',
        'assigned_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Get the user assigned to this task.
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to'); // Task belongs to user who is assigned
    }

    /**
     * Get the user who created/assigned this task.
     */
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by'); // Task belongs to user who created it
    }

    /**
     * Get all the updates for this task.
     */
    public function updates()
    {
        return $this->hasMany(TaskUpdate::class); // Task can have many updates
    }

    /**
     * Get all the comments for this task.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class); // Task can have many comments
    }
}

