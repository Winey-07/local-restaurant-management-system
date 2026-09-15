<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;

Route::group(['prefix' => 'menuItems'], function(){
    Route::get('/', [MenuItemController::class, 'index']);
    Route::get('/{id}', [MenuItemController::class, 'show']);
    Route::post('/{id}', [MenuItemController::class,'store']);
    Route::put('/{id}', [MenuItemController::class], 'update');
    Route::delete('/{id}', [MenuItemController::class], 'destory');
});


