<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Izinkan mass assignment pada kolom berikut
    protected $fillable = ['nama', 'deskripsi', 'foto', 'harga'];
}
