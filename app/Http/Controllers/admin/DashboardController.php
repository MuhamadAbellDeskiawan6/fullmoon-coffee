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
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dashboard', compact('orders'));
        
    }
}
