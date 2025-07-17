<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->nama = $request->nama;
        $menu->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            $menu->foto = $request->file('foto')->store('menus', 'public');
        }

        $menu->save();

        return redirect('/admin/menus')->with('success', 'Menu berhasil diupdate');
    }
}
