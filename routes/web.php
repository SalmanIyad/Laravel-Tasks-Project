<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

// Auth Routes
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginPost']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerPost']);

// Profile Management Routes
Route::get('/profile/edit', [AuthController::class, 'edit']);
Route::put('/profile/update', [AuthController::class, 'update']);
Route::delete('/profile/delete', [AuthController::class, 'destroy']);

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index']);

// Books Browsing Route (Public)
Route::get('/books', [BookController::class, 'index']);

// Admin Book Management Routes
Route::prefix('admin/books')->group(function () {
    Route::get('/create', [BookController::class, 'create']);
    Route::post('/store', [BookController::class, 'store']);
    Route::get('/{id}/edit', [BookController::class, 'edit']);
    Route::put('/{id}', [BookController::class, 'update']);
    Route::delete('/{id}', [BookController::class, 'destroy']);
});