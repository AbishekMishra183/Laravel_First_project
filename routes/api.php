<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MasterMakeController;
use App\Http\Controllers\Api\MasterModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function (Request $request) {
    return 'test hello';
});


Route::post('/hello', function (Request $request) {
    return 'test ....';
});

Route::post('/login', [AuthController::class,'login']);

Route::post('/register', [AuthController::class,'register']);
Route::get('/profile', [AuthController::class,'getProfile'])->middleware('auth:sanctum');//401 error aauxa yo matrai garda chai
Route::apiResource('makes', MasterMakeController::class);
Route::apiResource('makes.models', MasterModelController::class);