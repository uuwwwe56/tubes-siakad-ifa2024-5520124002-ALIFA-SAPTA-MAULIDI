<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika belum login, tendang ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika role tidak sesuai, beri error 403 (Unauthorized)
        if (Auth::user()->role !== $role) {
            abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}
