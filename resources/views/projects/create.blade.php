@extends('layouts.app')

@section('title','Create Project')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-lg font-semibold mb-4">Create New Project</h2>

    <form action="{{ route('project.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Project Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Project Title
            </label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title') }}"
                   class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 
                          dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                   required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Description
            </label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 
                             dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                      required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Status
            </label>
            <select name="status" id="status"
                    class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 
                           dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                    required>
                <option value="Pending" {{ old('status')==='Pending'?'selected':'' }}>Pending</option>
                <option value="InProgress" {{ old('status')==='InProgress'?'selected':'' }}>InProgress</option>
                <option value="Submitted" {{ old('status')==='Submitted'?'selected':'' }}>Submitted</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Submit -->
        <div>
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Save Project
            </button>
        </div>

</form>   
 @endsection