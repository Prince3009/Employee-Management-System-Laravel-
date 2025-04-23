@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $task->title }}" 
                {{ auth()->user()->role === 'employee' ? 'readonly' : '' }} required>
        </div>

        @if(auth()->user()->role === 'manager')
            <div class="form-group">
                <label for="assigned_to">Assign to</label>
                <select name="assigned_to" id="assigned_to" class="form-control" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == $task->assigned_to ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" 
                {{ auth()->user()->role === 'employee' ? 'readonly' : '' }}>{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" name="due_date" id="due_date" 
                value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}" 
                {{ auth()->user()->role === 'employee' ? 'readonly' : '' }}>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="progress_note">Progress Note</label>
            <textarea name="progress_note" id="progress_note" class="form-control">{{ $task->progress_note }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Update Task</button>
    </form>
@endsection
