<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/user', [UserController::class, 'register']);
Route::get('/users', [UserController::class, 'index']);