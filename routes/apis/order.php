<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get ('/order', [OrderController::class, 'index']);
Route::get ('/order/create', [OrderController::class, 'create']);
Route::post('/order', [OrderController::class, 'store']);   
Route::get ('/order/{id}', [OrderController::class, 'show']);
Route::put ('/order/{id}', [OrderController::class, 'update']);
Route::delete ('/order/{id}', [OrderController::class, 'destroy']);