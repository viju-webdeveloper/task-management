<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;


Route::get('/register', [UserController::class, 'index'])->name('register');
Route::post('/register', [UserController::class, 'store']);
Route::get('/login', [SessionController::class, 'index'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::get('/logout', [SessionController::class, 'destroy'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('task.store');
    Route::get('tasks/show/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/tasks/edit/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/tasks/edit/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/delete/{task}', [ TaskController::class, 'destroy'])->name('task.delete');
});
