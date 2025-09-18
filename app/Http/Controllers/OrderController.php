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

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);
        $order->update(['status' => $request->status]);

        // Kirim email notifikasi
        Mail::to('admin@example.com')->send(new OrderNotification($order));

        return redirect()->back()->with('success', 'Status order berhasil diupdate.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'menu_id'      => 'required|exists:menus,id',
            'jumlah'       => 'required|integer|min:1',
            'payment'      => 'required|in:qris,cash',
        ]);

        $order = Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'menu_id'      => $request->menu_id,
            'jumlah'       => $request->jumlah,
            'payment'      => $request->payment,
            'status'       => 'menunggu',
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

        // Simpan order ID di session untuk digunakan pada halaman success
        session(['last_order_id' => $order->id]);

        return view('payment.cash', compact('order'));
    }


    public function success(Request $request)
    {
        $method = $request->get('method', 'cash'); // default cash

        // Ambil order terakhir dari session
        $order = null;
        if ($request->session()->has('last_order_id')) {
            $order = Order::find($request->session()->get('last_order_id'));
        }

        // Jika order tidak ditemukan atau ID tidak valid, bisa lakukan redirect atau error handling
        if (!$order) {
            return redirect()->route('landing')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('success', compact('order', 'method'));
    }

    public function qrisDone($id)
    {
        // Cari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Pastikan statusnya belum 'diproses' sebelum kita ubah menjadi 'diproses'
        if ($order->status !== 'diproses') {
            $order->update([
                'status' => 'diproses'  // Ubah status jadi 'diproses'
            ]);
        }

        // Simpan order ID di session untuk digunakan pada halaman success
        session(['last_order_id' => $order->id]);

        // Redirect ke halaman success dengan metode qris
        return redirect()->route('order.success', ['method' => 'qris']);
    }
}
