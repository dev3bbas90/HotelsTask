<?php

use App\Http\Controllers\HotelsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hotels', [HotelsController::class , 'index']);
