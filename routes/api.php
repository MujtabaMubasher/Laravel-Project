<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('getUsers', [AuthController::class,'getUser'])->middleware('auth:sanctum');
Route::post('updateUser/{id}', [AuthController::class,'update'])->middleware('auth:sanctum');
Route::delete('deleteUser', [AuthController::class,'delete'])->middleware('auth:sanctum');

// post Controllers
Route::post('createPost', [PostController::class, 'create'])->middleware('auth:sanctum');
Route::get('getAllPost', [PostController::class, 'getAllPost'])->middleware('auth:sanctum');