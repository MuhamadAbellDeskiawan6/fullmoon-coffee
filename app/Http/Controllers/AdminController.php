<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.dashboard', compact('orders'));
    }

    public function updateStatus($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }

    // Menu Management
    public function menus()
    {
        $menus = Menu::all();
        return view('admin.menus', compact('menus'));
    }

    public function addMenu(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('menus', 'public');
        }

        Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
    }

    public function deleteMenu($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Menu berhasil dihapus.');
    }
}
