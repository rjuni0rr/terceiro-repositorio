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

    Route::get('/',[TaskController::class,'index'])->name('tasks.index');

    // create a new task
    Route::get('/tasks/create', [TaskController::class, 'createTask'])->name('tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'createTaskSubmit'])->name('tasks.create.submit');

    // edit task
    Route::get('/task/edit/{id}', [TaskController::class, 'editTask'])->name('tasks.edit');
    Route::post('/task/edit', [TaskController::class, 'editTaskSubmit'])->name('tasks.edit.submit');

//    // delete a queue
//    Route::get('/queue/delete/{id}', [MainController::class, 'deleteQueue'])->name('queue.delete');
//    Route::get('/queue/delete-confirm/{id}', [MainController::class, 'deleteQueueConfirm'])->name('queue.delete.confirm');

//    Route::resource('tasks',TaskController::class);



    Route::post('/categories', [CategoryController::class,'createCategorySubmit'])->name('create.category.submit');








    Route::post('/logout',[AuthController::class,'logout']);
});


