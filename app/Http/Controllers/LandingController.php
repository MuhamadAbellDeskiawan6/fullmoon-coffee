<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class LandingController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('landing', compact('menus'));
    }
}
