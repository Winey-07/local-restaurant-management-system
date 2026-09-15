<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Router::group(['prefix' => 'menuItems'], function(){
    Route::get('/', [MenuItemController::class, index]);
    Route::get('/{id}', [MenuItemController::class, show]);
    Route::post('/', [MenuItemController::class,store]);
});

