<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user_loginController;


Route::get('/users', [user_loginController::class, 'index']);
Route::post('/users', [user_loginController::class, 'store']);