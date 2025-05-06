<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactorAuth
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && !session()->has('two_factor_verified') && $request->route()->getName() !== 'two-factor.index') {
            return redirect()->route('two-factor.index');
        }

        return $next($request);
    }
}
