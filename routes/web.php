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

    Route::get('/',[TaskController::class,'index']);

    Route::resource('categories',CategoryController::class);

    Route::resource('tasks',TaskController::class);






    Route::post('/logout',[AuthController::class,'logout']);
});


