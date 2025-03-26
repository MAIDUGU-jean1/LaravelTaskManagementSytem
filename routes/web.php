<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LogicController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [RegisterController::class, 'welcome'])->name('welcome');

// Route::middleware('guest')->group(function () {

// });
Route::get('/register', [RegisterController::class, 'showRegister'])->name('show_register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLogin'])->name('show_login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    
    Route::get('/index', [LogicController::class, 'index'])->name('index');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    
    Route::get('/tasks/create', [LogicController::class, 'Create_task'])->name('create_task');
    Route::post('/tasks', [LogicController::class, 'store'])->name('store');
    Route::get('/tasks/{task}/edit', [LogicController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [LogicController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [LogicController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/due', [LogicController::class, 'getDueTasks']);
    Route::get('tasks/download', [LogicController::class, 'downloadTasksPDF'])->name('tasks.downloadPDF');
    Route::post('/tasks/{task}/share', [TaskController::class, 'shareTask'])->name('tasks.share');


    Route::get('/profile/edit', [LogicController::class, 'ShowProfile'])->name('profile.show');
    Route::put('/profile/edit', [LogicController::class, 'UpdateProfile'])->name('profile.Update');
    Route::get('/profile/password', [LogicController::class, 'showPasswordForm'])->name('showPasswordForm');
    Route::put('/profile/password', [LogicController::class, 'updatePassword'])->name('password');
});

