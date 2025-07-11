<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function landing()
    {
        // Dummy menu
        $menus = [
            ['nama' => 'Espresso', 'deskripsi' => 'Kopi hitam pekat khas Fullmoon', 'foto' => 'https://source.unsplash.com/400x400/?coffee,espresso'],
            ['nama' => 'Latte', 'deskripsi' => 'Kopi susu creamy lembut', 'foto' => 'https://source.unsplash.com/400x400/?coffee,latte'],
            ['nama' => 'Cappuccino', 'deskripsi' => 'Kopi susu dengan foam tebal', 'foto' => 'https://source.unsplash.com/400x400/?coffee,cappuccino'],
        ];

        return view('landing', compact('menus'));
    }

    public function orderForm()
    {
        // Dummy menu sama seperti landing
        $menus = [
            ['nama' => 'Espresso'],
            ['nama' => 'Latte'],
            ['nama' => 'Cappuccino'],
        ];

        return view('order', compact('menus'));
    }

    public function orderSubmit(Request $request)
    {
        if (session('ordered_today')) {
            return back()->with('error', 'Maaf, kamu sudah memesan hari ini. Silakan pesan lagi besok.');
        }

        $nama = $request->nama_pemesan;
        $menu = $request->menu;
        $ig = $request->username_ig;
        $wa = preg_replace('/[^0-9]/', '', $request->no_whatsapp);
        if (substr($wa, 0, 1) == '0') {
            $wa = '62' . substr($wa, 1);
        }
        $link_story = $request->link_story;

        $pesan = "Halo Admin Fullmoon Coffee!\n\nPesanan Baru:\nNama: $nama\nMenu: $menu\nIG: $ig\nWA: $wa\nLink Story: $link_story";

        // Simpan flag order hari ini
        session(['ordered_today' => Carbon::now()]);

        // Redirect ke WA Admin
        $url = "https://wa.me/62895402474500?text=" . urlencode($pesan);

        return redirect($url);
    }
}
