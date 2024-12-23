<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            // Admin bisa mengakses semua rute
            if ($userRole === 'admin') {
                return $next($request);
            }

            // Karyawan hanya bisa mengakses rute tertentu
            if ($userRole === 'karyawan') {
                $allowedRoutes = [
                    'transaksi',
                    'dataTransaksi',
                    'savetransaksi',
                    'detail',
                    'pdf'
                ];

                // Cek apakah rute saat ini termasuk dalam daftar yang diizinkan
                if (in_array($request->route()->getName(), $allowedRoutes)) {
                    return $next($request);
                }
            }
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
