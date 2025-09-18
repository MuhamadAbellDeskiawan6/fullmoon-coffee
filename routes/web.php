<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// ============================
// Public Routes
// ============================

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Order page
Route::get('/order', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// Payment pages
Route::get('/payment/qris/{id}', [OrderController::class, 'qris'])->name('payment.qris');
Route::get('/payment/cash/{id}', [OrderController::class, 'cash'])->name('payment.cash');

// Order limit page
Route::get('/limit', function () {
    return view('limit');
})->name('order.limit');

// Success page
Route::get('/success', [OrderController::class, 'success'])->name('order.success');

// Route untuk update status QRIS
Route::post('/payment/qris/{id}/done', [OrderController::class, 'qrisDone'])->name('payment.qris.done');


// ============================
// Admin Authentication Routes
// ============================

// Show login form
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
// Handle login
Route::post('/admin/login', [AdminAuthController::class, 'login']);
// Logout
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ============================
// Admin Protected Routes
// ============================
Route::middleware('admin.auth')->group(function () {

    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ============================
    // Admin Menu Management
    // ============================
    Route::get('/admin/menus', [MenuController::class, 'index'])->name('admin.menus');
    Route::post('/admin/menus/add', [MenuController::class, 'store'])->name('admin.menus.add');
    Route::get('/admin/menus/{id}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
    Route::put('/admin/menus/{id}/update', [MenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('/admin/menus/{id}', [MenuController::class, 'destroy'])->name('admin.menus.delete');

    // ============================
    // Admin Order Management
    // ============================
    Route::get('/admin/order', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::post('/admin/order/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});
