<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Register route
Route::post('/register', [AuthController::class, 'register']);

// Login route
Route::post('/login', [AuthController::class, 'login']);

// Authenticated user route (with Sanctum middleware)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Profile route — POST, no middleware
Route::get('/profile', [AuthController::class, 'getProfile'])->middleware('auth:sanctum');

// Test route
Route::get('/hello', function () {
    return 'test hello';
});
