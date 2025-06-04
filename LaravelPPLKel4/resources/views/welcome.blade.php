<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodRescue</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-blue-100">
<style>
    main {
        color: black;
        font-size: 18px;
    }
    b {
        background-color: #f5f5f5;
    }
</style>
<nav class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <span class="flex items-center gap-2 text-xl font-bold text-blue-600 hover:text-blue-700 transition">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            FloodRescue
        </span>
        <div>
            @auth
                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-3">
                        <dotlottie-player
                            src="https://lottie.host/06e4e57a-f9d6-443c-ab07-6de34da61307/DHBDrVzYes.lottie"
                            background="transparent"
                            speed="1"
                            style="width: 30px; height: 30px;"
                            loop
                            autoplay>
                        </dotlottie-player>
                        <div class="text-left leading-tight">
                            <p class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                        <button type="submit"
                                class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                @if (Request::is('login'))
                    <a href="/register" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Register</a>
                @else
                    <a href="/login" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Login</a>
                @endif
            @endauth
        </div>
    </div>
</nav>
<div class="col-12 text-center">
    <div class="welcome-container" style="padding: 4rem 2rem;">
        <div class="logo-container mb-4" style="display: flex; justify-content: center; align-items: center;">
            <img src="{{ asset('images/logo.png') }}" alt="FloodRescue Logo" class="welcome-logo animate-float" 
                    style="width: 200px; height: auto; margin: 0 auto;">
        </div>
        
        <h1 class="mega-title mb-4 animate-fade-in" style="font-family: 'Poppins', sans-serif; font-size: 4.5rem; font-weight: 700; color: #1565c0; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
            Selamat datang di FloodRescue!
        </h1>
        
        <p class="sub-title animate-fade-in-delay" style="font-family: 'Poppins', sans-serif; font-size: 2rem; color: #424242; margin-bottom: 2rem;">
            Bersama Lawan Banjir
        </p>
        
        <div class="countdown-container animate-fade-in-delay-2" style="background: rgba(255, 255, 255, 0.9); padding: 1rem 2rem; border-radius: 15px; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <p class="countdown mb-0" style="font-family: 'Poppins', sans-serif; font-size: 1.2rem; color: #666;">
                Mengalihkan ke halaman utama dalam <span id="timer" style="font-weight: 600; color: #1565c0;">5</span> detik...
            </p>
        </div>
    </div>
</div>
<footer class="bg-white text-black text-center py-5 mt-6">
    <div class="text-sm">
        © 2025 FloodRescue. All rights reserved.
    </div>
</footer>
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-fade-in {
    opacity: 0;
    animation: fadeIn 1s ease-out forwards;
}

.animate-fade-in-delay {
    opacity: 0;
    animation: fadeIn 1s ease-out 0.5s forwards;
}

.animate-fade-in-delay-2 {
    opacity: 0;
    animation: fadeIn 1s ease-out 1s forwards;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Tambahan styling untuk logo */
.logo-container {
    min-height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.welcome-logo {
    display: block;
    max-width: 100%;
    object-fit: contain;
}

@media (max-width: 768px) {
    .mega-title {
        font-size: 3rem !important;
    }
    .sub-title {
        font-size: 1.5rem !important;
    }
    .welcome-logo {
        width: 80px !important;
    }
    .logo-container {
        min-height: 100px;
    }
    .welcome-logo {
        width: 150px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let timeLeft = 5;
    const timerElement = document.getElementById('timer');
    
    const countdown = setInterval(function() {
        timeLeft--;
        timerElement.textContent = timeLeft;
        
        if (timeLeft <= 0) {
            clearInterval(countdown);
            window.location.href = '/home';
        }
    }, 1000);
});
</script>
</body>
</html>