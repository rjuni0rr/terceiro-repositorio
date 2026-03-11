<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;


Route::middleware('guest')->group(function(){

    // authentication (login)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');

    // criar conta (login)
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'registerSubmit'])->name('register.submit');

});

Route::middleware('auth')->group(function(){

    // index
    Route::get('/',[TaskController::class,'index'])->name('tasks.index');

    // create a new task
    Route::get('/tasks/create', [TaskController::class, 'createTask'])->name('tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'createTaskSubmit'])->name('tasks.create.submit');



    // edit task
    Route::get('/task/{id}/edit', [TaskController::class, 'editTask'])->name('tasks.edit');
    Route::put('/task/{id}', [TaskController::class, 'editTaskSubmit'])->name('tasks.edit.submit');

    // delete a queue
    Route::get('/task/{id}/delete', [TaskController::class, 'deleteTask'])->name('tasks.delete');
    Route::delete('/task/{id}', [TaskController::class, 'deleteTaskConfirm'])->name('tasks.delete.confirm');

    // criar categoria
    Route::post('/categories', [CategoryController::class,'createCategorySubmit'])->name('create.category.submit');

    // logout
    Route::post('/logout',[AuthController::class,'logout']);
});


