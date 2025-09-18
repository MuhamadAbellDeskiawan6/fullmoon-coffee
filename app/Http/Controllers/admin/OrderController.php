<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
public function updateStatus(Request $request, Order $order)
{
    // Validasi input
    $request->validate([
        'status' => 'required|in:menunggu,diproses,selesai',
    ]);

    // Update status
    $order->update([
        'status' => $request->status
    ]);

    // Redirect balik ke dashboard dengan pesan sukses
    return redirect()->back()->with('success', 'Status order berhasil diupdate.');
}
}