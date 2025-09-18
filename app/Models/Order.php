<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Izinkan mass assignment
    protected $fillable = [
        'menu_id',
        'jumlah',
        'payment',
        'status',
        'preferensi_rasa',
        'feedback_consent',
        'feedback_agreement',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
