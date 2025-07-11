<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FullmoonController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function order()
    {
        return view('order');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'menu_id' => 'required',
            'username_ig' => 'required',
            'no_whatsapp' => 'required',
        ]);

        $no_wa_admin = '628xxxxxxxxxx'; // GANTI dengan nomor WA adminmu tanpa + (pakai 62)

        $pesan = "Halo Admin Fullmoon Coffee!%0A%0A"
            . "Pesanan Baru:%0A"
            . "Nama: {$request->nama_pemesan}%0A"
            . "Menu: {$request->menu_id}%0A"
            . "IG: {$request->username_ig}%0A"
            . "WA: {$request->no_whatsapp}%0A"
            . "Link Story: {$request->link_story}";

        return redirect("https://wa.me/{$no_wa_admin}?text={$pesan}");
    }

    public function success()
    {
        return view('success');
    }
}
