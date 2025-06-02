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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->two_factor_enabled) {
                $user->generateTwoFactorCode();
                session(['two_factor_user_id' => $user->id]);

                try {
                    if (!$user->two_factor_code) {
                        throw new \Exception('Kode verifikasi tidak dapat dibuat.');
                    }

                    Mail::to($user->email)->send(new TwoFactorCode($user));
                } catch (\Exception $e) {
                    \Log::error('Two Factor Auth Error: ' . $e->getMessage());
                    return back()->withErrors(['email' => 'Gagal mengirim kode verifikasi. Silakan coba lagi.']);
                }

                return redirect()->route('two-factor.index');
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Anda telah berhasil login sebagai admin!');
            }

            return redirect()->route('welcome')->with('success', 'Anda telah berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home')->with('success', 'Anda telah berhasil logout!');
    }
}

