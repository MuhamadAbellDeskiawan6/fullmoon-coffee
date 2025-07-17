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
        return view('order', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'no_whatsapp' => 'required',
            'menu_id' => 'required',
            'username_ig' => 'required',
            'link_story' => 'nullable|url',
            'foto_story' => 'nullable|image|max:2048',
        ]);

        // Cek order hari ini dengan username IG
        $existingOrder = Order::where('username_ig', $request->username_ig)
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($existingOrder) {
            return redirect()->back()->with('error', 'Maaf, Anda sudah memesan hari ini. Silakan pesan lagi besok.');
        }

        // Format nomor WA
        $no_wa = preg_replace('/[^0-9]/', '', $request->no_whatsapp);
        if (substr($no_wa, 0, 1) == '0') {
            $no_wa = '62' . substr($no_wa, 1);
        }

        // Simpan foto story jika ada
        $fotoStory = null;
        if ($request->hasFile('foto_story')) {
            $fotoStory = $request->file('foto_story')->store('stories', 'public');
        }

        // ✅ Buat order dan simpan foto_story juga
        $order = Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'menu_id' => $request->menu_id,
            'username_ig' => $request->username_ig,
            'link_story' => $request->link_story,
            'no_whatsapp' => $no_wa,
            'foto_story' => $fotoStory, // ⬅️ tambahkan ini agar tersimpan di DB
            'status' => 'pending',
        ]);

        // Kirim email notifikasi ke admin
        Mail::to('muhamadabelldeskiawan@gmail.com')->send(new OrderNotification($order));

        // Simpan flag session
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
