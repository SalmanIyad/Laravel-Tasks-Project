<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginPost']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerPost']);

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index']);

// Books Routes
Route::get('/books', [BookController::class, 'index']);

Route::get('/books/create', [BookController::class, 'create']);

Route::post('/books/store', [BookController::class, 'store']);

Route::get('/books/{id}/edit', [BookController::class, 'edit']);

Route::put('/books/{id}', [BookController::class, 'update']);

Route::delete('/books/{id}', [BookController::class, 'destroy']);