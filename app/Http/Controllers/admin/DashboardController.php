<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua orders
        $orders = Order::with('menu')->latest()->get();

        return view('admin.dashboard', compact('orders'));
    }
}
