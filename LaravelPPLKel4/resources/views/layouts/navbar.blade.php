<nav class="bg-white shadow sticky top-0 z-50">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <a href="/home" class="flex items-center gap-2 text-xl font-bold text-blue-600 hover:text-blue-700 transition">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            FloodRescue
        </a>

        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
            @if(auth()->check() && session('two_factor_verified'))
                <li><a href="/donasi" 
                    class="{{ Request::is('donasi*') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover: hover:text-blue-600' }}">
                    Donasi & Bantuan
                    </a>
                </li>
                <li>
                    <a href="/pasca"
                    class="{{ Request::is('pasca*') || Request::is('cleaning-request*') || Request::is('orders*') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover: hover:text-blue-600' }}">
                    Layanan Pasca Banjir
                    </a>
                </li>
                <li>
                    <a href="/laporan"
                    class="{{ Request::is('laporan*') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover: hover:text-blue-600' }}">
                    Laporan Banjir
                    </a>
                </li>
                <li>
                    <a href="/cuaca" 
                    class="{{ Request::is('cuaca*') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    Info Cuaca
                    </a>
                </li>
                <li>
                    <a href="/peta" 
                    class="{{ Request::is('peta*') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    Peta Wilayah
                    </a>
                </li>
            @endif
        </ul>
        
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

                    @if(Auth::user()->role === 'admin')
                        <a href="/admin/dashboard"
                        class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">
                            Dashboard
                        </a>
                    @endif

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
                    <a href="/register"
                    class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">
                        Register
                    </a>
                @else
                    <a href="/login"
                    class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">
                        Login
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>
