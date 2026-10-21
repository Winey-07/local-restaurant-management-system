<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/dashboard', [DashboardController::class, 'index']);

require __DIR__.'/apis/order.php';
require __DIR__.'/apis/payment.php';
require __DIR__.'/apis/orderItem.php';
require __DIR__.'/apis/menuItem.php';
require __DIR__.'/apis/user.php';
require __DIR__.'/apis/table.php';
require __DIR__.'/apis/category.php';

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');
 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
