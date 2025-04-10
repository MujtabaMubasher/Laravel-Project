<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


// View Routes
Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function(){
    return view('signup');
});

Route::get('/dashboard', function(){
    return view('dashboard');
});

// API Routes
Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login']);
Route::get('/dashboard',[UserController::class, 'dashboard']);
Route::get('/logout',[UserController::class, 'logout']); 
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');