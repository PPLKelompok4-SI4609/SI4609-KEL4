<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodRescue - @yield('title', 'Welcome')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-600 min-h-screen">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="FloodRescue Logo" class="h-8 w-auto">
                        <span class="ml-2 text-xl font-bold text-blue-600">FloodRescue</span>
                    </a>
                </div>
                <div class="flex items-center">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Register</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white mt-auto py-4">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} FloodRescue. Bersama Lawan Banjir!</p>
        </div>
    </footer>
</body>
</html>