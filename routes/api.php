<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/dashboard', [DashboardController::class, 'index']);

require __DIR__.'/apis/order.php';
require __DIR__.'/apis/payment.php';
require __DIR__.'/apis/order_item.php';
require __DIR__.'/apis/menu_item.php';
require __DIR__.'/apis/user.php';
require __DIR__.'/apis/restaurant_table.php';
require __DIR__.'/apis/category.php';