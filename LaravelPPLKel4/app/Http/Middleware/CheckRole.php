<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            return abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
