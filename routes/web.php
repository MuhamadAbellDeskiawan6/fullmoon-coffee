<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullmoonController;

Route::get('/', function () {
    return view('landing');
});



use App\Http\Controllers\OrderController;

Route::get('/', [OrderController::class, 'landing']);
Route::get('/order', [OrderController::class, 'orderForm']);
Route::post('/order', [OrderController::class, 'orderSubmit']);
Route::get('/success', function() {
    return view('success');
});
