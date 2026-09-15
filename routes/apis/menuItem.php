<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Router::get('/menuItems', function(Request $request){
    return $request->menuItem();
});

