@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pending -->
        <div class="bg-yellow-100 dark:bg-yellow-700 text-yellow-900 dark:text-yellow-100 p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Pending</h3>
            <p class="text-3xl font-bold mt-2">{{$pendingCount}}</p>
        </div>

        <!-- In Progress -->
        <div class="bg-blue-100 dark:bg-blue-700 text-blue-900 dark:text-blue-100 p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">In Progress</h3>
            <p class="text-3xl font-bold mt-2">{{$inProgressCount}}</p>
        </div>

        <!-- Submitted -->
        <div class="bg-green-100 dark:bg-green-700 text-green-900 dark:text-green-100 p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Submitted</h3>
            <p class="text-3xl font-bold mt-2">{{$submittedCount}}</p>
        </div>
    </div>
@endsection
