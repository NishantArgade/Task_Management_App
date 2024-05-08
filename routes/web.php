<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/task/my', [TaskController::class, 'myTasks'])->name('task.my');
    Route::get('/task/all-users', [TaskController::class, 'allUserTasks'])->name('task.all-users');
    Route::put('/task/update-status', [TaskController::class, 'updateTaskStatus'])->name('task.update-status');


    // Routes for Authorized user and admin only
    Route::middleware('admin')->group(function () {
        Route::get('/task/all', [TaskController::class, 'allTasks'])->name('task.all');
        Route::delete('/delete/user-task', [TaskController::class, 'deleteUserTask'])->name('delete.user-task');
    });
});


Route::resource('task', TaskController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
])->middleware(['auth', 'verified', 'admin']);

require __DIR__ . '/auth.php';
