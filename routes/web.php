<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {

    // inbox home page
    Route::get('/', [ProjectController::class, 'inbox'])->name('dashboard');

    // create project
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');

    // store project
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');

    // display the auth user projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.projects');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
