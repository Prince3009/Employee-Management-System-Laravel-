@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Task Details</h1>
            <div class="flex space-x-4">
                <a href="{{ route('tasks.edit', $task->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Edit Task</a>
                <a href="{{ route('tasks.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Back to Tasks</a>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">{{ $task->title }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600"><strong>Assigned To:</strong> {{ $task->assignee ? $task->assignee->name : 'Unassigned' }}</p>
                    <p class="text-gray-600"><strong>Assigned By:</strong> {{ $task->assigner ? $task->assigner->name : 'Unknown' }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><strong>Status:</strong> 
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </p>
                    <p class="text-gray-600"><strong>Due Date:</strong> 
                        {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date set' }}
                    </p>
                </div>
            </div>

            @if($task->description)
                <div class="mt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                    <p class="text-gray-600">{{ $task->description }}</p>
                </div>
            @endif

            @if($task->due_date && $task->due_date->isPast() && $task->status !== 'completed')
                <div class="mt-4 p-4 bg-red-50 rounded-lg">
                    <p class="text-red-600 font-semibold">⚠️ This task is overdue!</p>
                </div>
            @endif
        </div>

        <!-- Task Updates Section -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Task Updates</h3>
            @if($task->updates->count() > 0)
                <div class="space-y-4">
                    @foreach($task->updates as $update)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600">{{ $update->update_text }}</p>
                            <p class="text-sm text-gray-500 mt-2">{{ $update->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No updates yet.</p>
            @endif

            @if(Auth::id() === $task->assigned_to)
                <form action="{{ route('task.update', $task->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <textarea name="update_text" placeholder="Add your update..." 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Submit Update
                    </button>
                </form>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Comments</h3>
            @if($task->comments->count() > 0)
                <div class="space-y-4">
                    @foreach($task->comments as $comment)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-gray-700">{{ $comment->user->name }}</p>
                                    <p class="text-gray-600 mt-1">{{ $comment->body }}</p>
                                </div>
                                <span class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No comments yet.</p>
            @endif

            @if(Auth::check())
                <form action="{{ route('comments.store', $task->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <textarea name="body" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            rows="3" placeholder="Write a comment..." required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Post Comment
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
