<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\TaskCommentAdded;

class CommentController extends Controller
{
    // Store a new comment for a task
    public function store(Request $request, Task $task)
    {
        // Validate the comment content
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Create the comment and associate it with the task and the authenticated user
        $comment = $task->comments()->create([
            'user_id' => auth()->id(), // Use the authenticated user's ID
            'body' => $validated['body'],   // Get the comment body from the request
        ]);

        // Send notification to the manager
        $task->assigner->notify(new TaskCommentAdded($task, auth()->user(), $validated['body']));

        // Redirect back to the task page with a success message
        return redirect()->route('tasks.show', $task->id)->with('success', 'Comment added successfully!');
    }
}
