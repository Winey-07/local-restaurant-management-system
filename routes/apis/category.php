<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::group(['prefix'=>'categories'], function(){
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class], 'show');
    Route::post('/', [CategoryController::class], 'store');
    Route::put('/{id}', [CategoryController::class], 'update');
    Route::delete('/{id}', [CategoryController::class], 'destory');
});