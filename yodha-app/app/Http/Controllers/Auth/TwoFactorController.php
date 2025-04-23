<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
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
            'two_factor_code' => 'required|string',
        ]);

        $user = auth()->user();

        if ($request->input('two_factor_code') !== $user->two_factor_code) {
            return back()->withErrors(['two_factor_code' => 'Kode verifikasi tidak valid.']);
        }

        if ($user->two_factor_expires_at->isPast()) {
            return back()->withErrors(['two_factor_code' => 'Kode verifikasi telah kadaluarsa.']);
        }

        $user->resetTwoFactorCode();
        
        return redirect()->intended(route('dashboard'));
    }

    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        
        // Kirim kode melalui email
        Mail::to($user->email)->send(new TwoFactorCode($user));
        
        // Kirim kode melalui WhatsApp
        $whatsapp = new WhatsAppService();
        $whatsapp->sendMessage($user->phone_number, 'Kode verifikasi Anda: ' . $user->two_factor_code);

        return back()->with('status', 'Kode verifikasi telah dikirim ulang.');
    }
}