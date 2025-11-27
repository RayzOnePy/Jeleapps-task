<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('registration', [AuthController::class, 'registration']);
Route::post('login', [AuthController::class, 'login']);
Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
