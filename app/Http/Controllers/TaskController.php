<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Display the task creation form (only for managers)
    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view('tasks.create', compact('employees'));
    }

    // Store a newly created task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'title' => $request->input('title'),
            'assigned_to' => $request->input('assigned_to'),
            'assigned_by' => Auth::id(),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'status' => 'pending', // Add default status
        ]);

        // Load the relationship and send notification
        $assignedUser = User::find($request->input('assigned_to'));
        if ($assignedUser) {
            $assignedUser->notify(new TaskAssigned($task));
        }

        return redirect()->route('tasks.index')->with('success', 'Task created and assigned successfully.');
    }

    // Show list of tasks (for both managers and employees)
    public function index(Request $request)
    {
        $tasks = Task::query();

        if ($request->has('search') && $request->search) {
            $tasks = $tasks->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status) {
            $tasks = $tasks->where('status', $request->status);
        }

        if (Auth::user()->role === 'manager') {
            $tasks = $tasks->where('assigned_by', Auth::id());
        } else {
            $tasks = $tasks->where('assigned_to', Auth::id());
        }

        $tasks = $tasks->latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    // Show task details
    public function show(Task $task)
    {
        if (Auth::id() !== $task->assigned_to && Auth::id() !== $task->assigned_by) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.show', compact('task'));
    }

    // Edit a task (both manager and employee access with role-based limits)
    public function edit(Task $task)
    {
        if (Auth::id() !== $task->assigned_by && Auth::id() !== $task->assigned_to) {
            abort(403, 'Unauthorized action.');
        }

        $employees = User::where('role', 'employee')->get();
        return view('tasks.edit', compact('task', 'employees'));
    }

    // Update task with role-based logic
    public function update(Request $request, Task $task)
    {
        if (Auth::id() !== $task->assigned_by && Auth::id() !== $task->assigned_to) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed',
            'progress_note' => 'nullable|string',
        ]);

        if (Auth::user()->role === 'employee') {
            $task->update([
                'status' => $validated['status'],
                'progress_note' => $validated['progress_note'],
            ]);
        } else {
            $task->update($validated);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete task (only manager who created it)
    public function destroy(Task $task)
    {
        if (Auth::id() !== $task->assigned_by) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
