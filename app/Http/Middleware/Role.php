<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $roles)
    {
        // Ambil peran pengguna saat ini
        $userRole = Auth::user()->role;

        // Ubah daftar peran menjadi array
        $rolesArray = explode('|', $roles);

        // Periksa apakah peran pengguna ada di dalam array peran yang diizinkan
        if (!in_array($userRole, $rolesArray)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
