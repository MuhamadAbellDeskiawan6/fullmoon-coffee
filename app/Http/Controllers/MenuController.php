<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Tampilkan semua menu
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus', compact('menus'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:2048',
            'harga' => 'required|integer|min:0',
        ]);

        $menu = new Menu();
        $menu->nama = $request->nama;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;

        if ($request->hasFile('foto')) {
            $menu->foto = $request->file('foto')->store('menus', 'public');
        }

        $menu->save();

        return redirect('/admin/menus')->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id); // ambil menu berdasarkan id
        return view('admin.menus.edit', compact('menu')); // lempar ke view edit
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:2048',
            'harga' => 'required|integer|min:0',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->nama = $request->nama;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;

        if ($request->hasFile('foto')) {
            $menu->foto = $request->file('foto')->store('menus', 'public');
        }

        $menu->save();

        return redirect('/admin/menus')->with('success', 'Menu berhasil diupdate');
    }
}
