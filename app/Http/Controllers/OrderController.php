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
            'nama_pemesan' => 'required',
            'menu_id' => 'required',
            'setuju_feedback' => 'required',
            'lokasi' => 'required',
        ]);

        if (!$request->username_ig && !$request->no_whatsapp) {
            return redirect()->back()->with('error', 'Minimal isi Instagram atau WhatsApp.');
        }

        // Format nomor WA jika diisi
        $no_wa = null;
        if ($request->no_whatsapp) {
            $no_wa = preg_replace('/[^0-9]/', '', $request->no_whatsapp);
            if (substr($no_wa, 0, 1) == '0') {
                $no_wa = '62' . substr($no_wa, 1);
            }
        }

        // Cek apakah user sudah pernah order hari ini (bisa pakai WA atau IG)
        $existingOrderQuery = Order::whereDate('created_at', Carbon::today());
        if ($no_wa) {
            $existingOrderQuery->where('no_whatsapp', $no_wa);
        } elseif ($request->username_ig) {
            $existingOrderQuery->where('username_ig', $request->username_ig);
        }

        $existingOrder = $existingOrderQuery->first();
        if ($existingOrder) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar sebagai tester hari ini.');
        }

        // Cek kuota
        $approvedCountToday = Order::whereDate('created_at', Carbon::today())
            ->where('status', 'approved')
            ->count();

        if ($approvedCountToday >= 5) {
            return redirect()->back()->with('error', 'Maaf, kuota tester hari ini penuh. Coba lagi besok.');
        }

        // Simpan order
        $order = Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'menu_id' => $request->menu_id,
            'username_ig' => $request->username_ig,
            'no_whatsapp' => $no_wa,
            'lokasi' => $request->lokasi,
            'status' => 'pending',
        ]);

        // Kirim email notifikasi ke admin (tetap)
        Mail::to('muhamadabelldeskiawan@gmail.com')->send(new OrderNotification($order));

        $request->session()->put('order_success', true);
        $request->session()->put('last_order_id', $order->id);

        return redirect('/success');
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
