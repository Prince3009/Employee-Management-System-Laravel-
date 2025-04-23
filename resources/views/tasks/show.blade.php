@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $task->title }}</h1>
            <p class="text-gray-600 mt-2">Task Details</p>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('tasks.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Tasks
            </a>
            @if(auth()->user()->role === 'manager')
            <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Task
            </a>
            @endif
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Task Details Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                   ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($task->status) }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $task->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                   ($task->priority === 'medium' ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800') }}">
                                {{ ucfirst($task->priority) }} Priority
                            </span>
                        </div>
                        <div class="text-sm text-gray-500">
                            Created {{ $task->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-700">{{ $task->description }}</p>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Assigned To</h3>
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-600 font-medium">{{ substr($task->assignee->name, 0, 1) }}</span>
                                </div>
                                <span class="ml-3 text-gray-900">{{ $task->assignee->name }}</span>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Due Date</h3>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-900">{{ $task->due_date->format('F j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Updates Section -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Task Updates</h2>
                    
                    @if($task->updates->count() > 0)
                        <div class="space-y-6">
                            @foreach($task->updates as $update)
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-blue-600 font-medium">{{ substr($update->user->name, 0, 1) }}</span>
                                            </div>
                                            <span class="ml-3 text-gray-900">{{ $update->user->name }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $update->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700">{{ $update->update_text }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No updates yet</p>
                    @endif

                    @if(auth()->user()->id === $task->assigned_to)
                        <form action="{{ route('task.update', $task->id) }}" method="POST" class="mt-6">
                            @csrf
                            <div class="mb-4">
                                <label for="update_text" class="block text-sm font-medium text-gray-700 mb-2">Add Update</label>
                                <textarea name="update_text" id="update_text" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Submit Update
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Comments</h2>
                    
                    @if($task->comments->count() > 0)
                        <div class="space-y-6">
                            @foreach($task->comments as $comment)
                                <div class="border-l-4 border-gray-200 pl-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                <span class="text-gray-600 font-medium">{{ substr($comment->user->name, 0, 1) }}</span>
                                            </div>
                                            <span class="ml-3 text-gray-900">{{ $comment->user->name }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->body }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No comments yet</p>
                    @endif

                    <form action="{{ route('comments.store', $task->id) }}" method="POST" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Add Comment</label>
                            <textarea name="body" id="body" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Post Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
