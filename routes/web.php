<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {

    // inbox home page
    Route::get('/', [ProjectController::class, 'inbox'])->name('dashboard');

    // today page
    Route::get('/today', [ProjectController::class, 'today'])->name('project.today');
    ///////////////////////////////
    // create project form
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');

    // store project
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
    ///////////////////////////////
    ///////////////////////////////
    // create task form
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');

    // store task
    Route::post('/task', [TaskController::class, 'store'])->name('task.store');



    // show edit task form
    Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');

    // update task
    Route::patch('/task/{task}', [TaskController::class, 'update'])->name('task.update');

    // toggle task completion
    Route::patch('/task/{task}/completed', [TaskController::class, 'completed'])->name('task.completed');

    ///////////////////////////////

    // display the auth user projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.projects');

    // show project page
    Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
