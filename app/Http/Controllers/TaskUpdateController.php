<?php

namespace App\Http\Controllers;

use App\Models\TaskUpdate;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskUpdateController extends Controller
{
    // Store method to save task updates submitted by employees
    public function store(Request $request, Task $task)
    {
        // Validate the input
        $request->validate([
            'update_text' => 'required|string', // Ensure update text is provided and is a string
        ]);

        // Ensure only the assigned employee can submit updates
        if ($task->assigned_to != Auth::id()) {
            abort(403, 'Unauthorized action.'); // If the user is not the assigned employee, deny access
        }

        // Create a new task update
        TaskUpdate::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'update_text' => $request->input('update_text'), // Store the update text
        ]);

        // Redirect back to the task detail page with a success message
        return redirect()->route('tasks.show', $task->id)->with('success', 'Update submitted successfully.');
    }
}
