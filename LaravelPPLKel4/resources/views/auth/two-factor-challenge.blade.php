<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodRescue | 2FA</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-blue-100">
<nav class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <span class="flex items-center gap-2 text-xl font-bold text-blue-600 hover:text-blue-700 transition">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            FloodRescue
        </span>
    </div>
</nav>
@if(session('success'))
    <div id="success-alert" class="fixed top-14 left-1/2 transform -translate-x-1/2 z-50 w-[90%] max-w-xl px-6 py-4 rounded bg-green-100 text-green-800 shadow-lg transition-opacity duration-500">
        <span>{{ session('success') }}</span>
        <button onclick="closeAlert('success-alert')" class="absolute top-2 right-3 text-green-800 hover:text-green-600 text-lg font-bold">&times;</button>
    </div>
@endif

@if(session('error'))
    <div id="error-alert" class="fixed top-14 left-1/2 transform -translate-x-1/2 z-50 w-[90%] max-w-xl px-6 py-4 rounded bg-red-100 text-red-800 shadow-lg transition-opacity duration-500">
        <span>{{ session('error') }}</span>
        <button onclick="closeAlert('error-alert')" class="absolute top-2 right-3 text-red-800 hover:text-red-600 text-lg font-bold">&times;</button>
    </div>
@endif
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="FloodRescue Logo" class="h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-blue-600">Verifikasi Dua Faktor</h2>
            <p class="text-gray-600 mt-2">Masukkan kode verifikasi yang telah dikirim ke email Anda</p>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('two-factor.verify') }}">
            @csrf

            <div class="mb-6">
                <label for="two_factor_code" class="block text-sm font-medium text-gray-700 mb-2">
                    Kode Verifikasi
                </label>
                <input id="two_factor_code" 
                    type="text" 
                    name="two_factor_code" 
                    required 
                    autocomplete="off"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('two_factor_code') border-red-500 @enderror"
                    placeholder="Masukkan 6 digit kode">

                @error('two_factor_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col space-y-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-all duration-200">
                    Verifikasi Kode
                </button>

                <div class="text-center">
                    <a href="{{ route('two-factor.resend') }}" 
                       class="text-blue-600 hover:text-blue-800 text-sm"
                       onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                        Kirim ulang kode
                    </a>
                </div>
            </div>
        </form>

        <form id="resend-form" action="{{ route('two-factor.resend') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
<footer class="bg-white text-black text-center py-5 mt-6">
    <div class="text-sm">
        © 2025 FloodRescue. All rights reserved.
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ['success-alert', 'error-alert'].forEach(id => {
            const alert = document.getElementById(id);
            if (alert) {
                setTimeout(() => {
                    alert.classList.add('opacity-0');
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            }
        });
    });

    function closeAlert(id) {
        const alert = document.getElementById(id);
        if (alert) {
            alert.classList.add('opacity-0');
            setTimeout(() => alert.remove(), 500);
        }
    }
</script>
</body>
</html>