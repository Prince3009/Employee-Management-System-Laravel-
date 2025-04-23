<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a new comment for a task
    public function store(Request $request, Task $task)
    {
        // Validate the comment content
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Create the comment and associate it with the task and the authenticated user
        $task->comments()->create([
            'user_id' => auth()->id(), // Use the authenticated user's ID
            'body' => $request->body,   // Get the comment body from the request
        ]);

        // Redirect back to the task page with a success message
        return redirect()->route('tasks.show', $task->id)->with('success', 'Comment added successfully!');
    }
}
