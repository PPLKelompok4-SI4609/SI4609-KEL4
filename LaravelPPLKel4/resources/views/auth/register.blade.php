<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodRescue | Register</title>
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
        <a href="/home" class="flex items-center gap-2 text-xl font-bold text-blue-600 hover:text-blue-700 transition">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            FloodRescue
        </a>
        <div>
            @if (Request::is('login'))
                <a href="/register" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Register</a>
            @else
                <a href="/login" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Login</a>
            @endif
        </div>
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
<div class="flex justify-center items-center min-h-[80vh] mt-6">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
    <img src="{{ asset('images/logo.png') }}" alt="FloodRescue Logo" class="h-32 mx-auto mb-4">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Register dulu yuk!</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 w-full px-4 py-2 pr-10 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror">
                <span onclick="togglePassword('password', 'eye-icon-1')" class="absolute right-3 top-9 text-gray-600 cursor-pointer">
                    <i id="eye-icon-1" class="fas fa-eye"></i>
                </span>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8 relative">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required
                    class="mt-1 w-full px-4 py-2 pr-10 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                <span onclick="togglePassword('password-confirm', 'eye-icon-2')" class="absolute right-3 top-9 text-gray-600 cursor-pointer">
                    <i id="eye-icon-2" class="fas fa-eye"></i>
                </span>
            </div>

            <div class="flex justify-center items-center">
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-all duration-200">
                    Register
                </button>
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                </p>
            </div>
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

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
</script>
</body>
</html>
