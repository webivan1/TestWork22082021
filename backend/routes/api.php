<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('hotel', \App\Http\Controllers\HotelController::class);
