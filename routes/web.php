<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
Route::get('/project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
Route::get('/project/{project}/update', [ProjectController::class, 'update'])->name('update.edit');

Route::resource('projects', ProjectController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
