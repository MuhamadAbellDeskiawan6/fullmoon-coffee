<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah admin_id ada di session
        if (!session()->has('admin_id')) {
            return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Lanjutkan request
        $response = $next($request);

        // Tambahkan header agar halaman tidak di-cache oleh browser
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
