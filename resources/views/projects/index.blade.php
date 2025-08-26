@extends('layouts.app')

@section('title','Projects')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">All Projects</h2>
        <a href="{{ route('projects.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Project
        </a>
    </div>
    <!-- Filter Section -->
<div class="mb-4">
    <form method="GET" action="{{ route('project.index') }}" class="flex items-center space-x-3">
        <label for="status" class="font-semibold">Filter by Status:</label>
        <select name="status" id="status" class="border rounded px-2 py-1 min-w-[120px] dark:bg-gray-700">
            <option value="">-- All --</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="inprogress" {{ request('status') == 'inprogress' ? 'selected' : '' }}>In Progress</option>
            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Filter</button>
    </form>
</div>


    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Project Title</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $index => $project)
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $project->title }}</td>
                    <td class="px-4 py-2">{{ $project->description }}</td>
                    <td class="px-4 py-2">
                        @if($project->status === 'Pending')
                            <span class="px-2 py-1 text-xs rounded bg-yellow-200 text-yellow-800">Pending</span>
                        @elseif($project->status === 'InProgress')
                            <span class="px-2 py-1 text-xs rounded bg-blue-200 text-blue-800">In Progress</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-green-200 text-green-800">Submitted</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <a href="{{ route('projects.edit',$project) }}" 
                           class="px-2 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600">Edit</a>
                        <form action="{{ route('projects.destroy',$project) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                    onclick="return confirm('Delete this project?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-300">
                        No projects found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
