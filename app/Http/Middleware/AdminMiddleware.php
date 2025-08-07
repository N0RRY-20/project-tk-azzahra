<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login DAN perannya adalah 'admin'
        if (Auth::check() && Auth::user()->peran === 'admin') {
            // Jika ya, izinkan permintaan untuk melanjutkan
            return $next($request);
        }

        // Jika tidak, tolak akses (Error 403 Forbidden)
        abort(403, 'AKSES DITOLAK. HANYA UNTUK ADMIN.');
    }
}
