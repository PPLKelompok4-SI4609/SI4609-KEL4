<aside class="w-64 min-w-[16rem] h-screen bg-white border-r border-gray-200 hidden md:flex flex-col justify-between">
    <div class="p-6">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            <h1 class="text-2xl font-bold text-blue-600 hover:text-blue-800 transform transition hover:">FloodRescue</h1>
        </a>
        <p class="text-sm text-gray-500 mt-1">Admin Panel</p>
    </div>
    @auth
        <div class="flex items-center space-x-3 ml-6">
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
    @endauth
    <nav class="flex-1 px-4 mt-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
            class="block px-4 py-2 rounded-lg transition 
                {{ Request::is('admin/dashboard') ? 'text-blue-700 font-semibold bg-blue-100' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-600' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.laporan.index') }}" 
            class="block px-4 py-2 rounded-lg transition 
                {{ Request::is('admin/laporan') || Request::is('admin/laporan/*') || Request::is('bantuan-darurat') ? 'text-blue-700 font-semibold bg-blue-100' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-600' }}">
            Laporan Banjir
        </a>
        <a href="{{ route('admin.articles.index') }}" 
            class="block px-4 py-2 rounded-lg transition 
                {{ Request::is('admin/artikel') || Request::is('admin/artikel/*') ? 'text-blue-700 font-semibold bg-blue-100' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-600' }}">
            Artikel
        </a>
        <a href="{{ route('admin.users.index') }}" 
            class="block px-4 py-2 rounded-lg transition 
                {{ Request::is('admin/kelola-user') || Request::is('admin/kelola-user/*') ? 'text-blue-700 font-semibold bg-blue-100' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-600' }}">
            Pengguna
        </a>
        <a href="{{ route('admin.cleaning.index') }}" 
            class="block px-4 py-2 rounded-lg transition 
                {{ Request::is('admin/pembersihan') || Request::is('admin/pembersihan/*') ? 'text-blue-700 font-semibold bg-blue-100' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-600' }}">            Layanan Pasca Banjir
        </a>
        <a href="{{ route('admin.map.index') }}" 
            class="block px-4 py-2 rounded-lg transition 
                {{ Request::is('admin/peta-banjir') || Request::is('admin/peta-banjir/*') ? 'text-blue-700 font-semibold bg-blue-100' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-600' }}">
            Peta Wilayah Banjir
        </a>
    </nav>
    <div class="p-4 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center px-4 py-2 rounded-lg text-gray-700 hover:bg-red-100 hover:text-red-600 transition">
                Logout
            </button>
        </form>
    </div>
</aside>

<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
