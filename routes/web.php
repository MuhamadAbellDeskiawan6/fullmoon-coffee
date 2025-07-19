<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MenuController;

// ✅ Tambahkan route limit di luar middleware
Route::get('/limit', function () {
    return view('limit');
});

Route::get('/', [LandingController::class, 'index']);
Route::get('/order', [OrderController::class, 'create']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/success', [OrderController::class, 'success']);
Route::get('/admin/menus/{id}/edit', [MenuController::class, 'edit']);
Route::put('/admin/menus/{id}/update', [MenuController::class, 'update']);


// 🔐 Admin Login Routes (tidak perlu middleware admin.auth)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout']);

// 🔒 Admin Protected Routes
Route::middleware('admin.auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index']);

    // Order Management
    Route::post('/admin/order/{id}/status', [AdminController::class, 'updateStatus']);

    // Menu Management
    Route::get('/admin/menus', [AdminController::class, 'menus']);
    Route::post('/admin/menus/add', [AdminController::class, 'addMenu']);
    Route::delete('/admin/menus/{id}', [AdminController::class, 'deleteMenu']);
    
});
