<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function create()
    {
        $menus = \App\Models\Menu::all();

        $approvedToday = \App\Models\Order::whereDate('created_at', \Carbon\Carbon::today())
            ->where('status', 'approved')
            ->count();

        if ($approvedToday >= 5) {
            return redirect('/limit');
        }

        return view('order', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah'  => 'required|integer|min:1',
            'payment' => 'required|in:qris,cash',
        ]);

        $order = Order::create([
            'menu_id' => $request->menu_id,
            'jumlah'  => $request->jumlah,
            'payment' => $request->payment,
            'status'  => 'menunggu',
        ]);

        

        if ($request->payment === 'qris') {
            return redirect()->route('payment.qris', $order->id);
        } else {
            return redirect()->route('payment.cash', $order->id);
        }
    }
    public function qris($id)
    {
        $order = Order::findOrFail($id);
        return view('payment.qris', compact('order'));
    }

    public function cash($id)
    {
        $order = Order::findOrFail($id);
        return view('payment.cash', compact('order'));
    }


    public function success(Request $request)
    {
        if (!$request->session()->has('order_success')) {
            return redirect('/order');
        }

        // Ambil order terakhir jika perlu
        $order = null;
        if ($request->session()->has('last_order_id')) {
            $order = Order::find($request->session()->get('last_order_id'));
        }

        // Hapus flag agar tidak bisa refresh ulang
        $request->session()->forget('order_success');
        $request->session()->forget('last_order_id');

        return view('success', compact('order'));
    }
}
