<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCode;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            $user->generateTwoFactorCode();

            // Kirim kode verifikasi via email
            Mail::to($user->email)->send(new TwoFactorCode($user));

            // Kirim kode verifikasi via WhatsApp
            $whatsapp = new WhatsAppService();
            $whatsapp->sendMessage($user->phone_number, 'Kode verifikasi FloodRescue Anda: ' . $user->two_factor_code);

            return redirect()->route('two-factor.show');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
