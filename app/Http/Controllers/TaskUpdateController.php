<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUpdate;
use Illuminate\Http\Request;
use App\Notifications\TaskStatusUpdated;

class TaskUpdateController extends Controller
{
    // Store method to save task updates submitted by employees
    public function store(Request $request, Task $task)
    {
        // Validate the input
        $validated = $request->validate([
            'update_text' => 'required|string|max:1000',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        // Create a new task update
        $update = TaskUpdate::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'update_text' => $validated['update_text']
        ]);

        // Update task status if changed
        if ($task->status !== $validated['status']) {
            $task->update(['status' => $validated['status']]);
            
            // Send notification to the manager
            $task->assigner->notify(new TaskStatusUpdated($task, auth()->user(), $validated['status']));
        }

        // Redirect back to the task detail page with a success message
        return redirect()->route('tasks.show', $task->id)->with('success', 'Update submitted successfully.');
    }
}
