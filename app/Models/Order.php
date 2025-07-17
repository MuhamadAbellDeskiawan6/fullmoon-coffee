<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Izinkan mass assignment
    protected $fillable = [
        'nama_pemesan',
        'menu_id',
        'username_ig',
        'link_story',
        'no_whatsapp',
        'foto_story',
        'status',
    ];

    // Jika ada relasi menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
