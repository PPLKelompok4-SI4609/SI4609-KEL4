<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCode;

class TwoFactorController extends Controller
{
    public function show()
    {
        return view('auth.two-factor-challenge');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|numeric|digits:6'
        ]);

        $user = User::find(session('two_factor_user_id'));

        if ($request->input('two_factor_code') !== $user->two_factor_code) {
            return back()->withErrors([
                'two_factor_code' => 'Kode yang Anda masukkan tidak valid.'
            ]);
        }

        if (now()->isAfter($user->two_factor_expires_at)) {
            return back()->withErrors([
                'two_factor_code' => 'Kode verifikasi sudah kadaluarsa.'
            ]);
        }

        session(['auth.two_factor_confirmed' => true]);
        $user->resetTwoFactorCode();
<<<<<<< Updated upstream:yodha-app/app/Http/Controllers/Auth/TwoFactorController.php
        
        return redirect()->intended(route('dashboard'));
=======

        return redirect()->intended('dashboard');
>>>>>>> Stashed changes:LaravelPPLKel4/app/Http/Controllers/Auth/TwoFactorController.php
    }

    public function resend()
    {
        $user = User::find(session('two_factor_user_id'));
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'Tidak dapat menemukan pengguna.'
            ]);
        }

        $user->generateTwoFactorCode();
        Mail::to($user->email)->send(new TwoFactorCode($user));

        return back()->with('status', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }
}