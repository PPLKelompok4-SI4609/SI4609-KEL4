<nav class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Logo Kiri -->
        <a href="/" class="flex items-center gap-2 text-xl font-bold text-blue-600 hover:text-blue-700 transition">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            FloodRescue
        </a>

        <!-- Menu Tengah -->
        <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
            <li><a href="#" class="hover:text-blue-600 transition">Donasi & Bantuan</a></li>
            <li><a href="#" class="hover:text-blue-600 transition">Layanan Pasca Banjir</a></li>
            <li>
                <a href="/laporan-banjir"
                class="{{ Request::is('laporan-banjir') || Request::is('status-laporan') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover: hover:text-blue-600' }}">
                Form Laporan Banjir
                </a>
            </li>
            <li>
                <a href="/cuaca" 
                class="{{ Request::is('cuaca*') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    Info Cuaca
                </a>
            </li>
            <li><a href="#" class="hover:text-blue-600 transition">Peta Wilayah</a></li>
        </ul>

        <!-- Lottie Icon Kanan -->
        <div class="flex items-center">
            <dotlottie-player
                src="https://lottie.host/06e4e57a-f9d6-443c-ab07-6de34da61307/DHBDrVzYes.lottie"
                background="transparent"
                speed="1"
                style="width: 30px; height: 30px;"
                loop
                autoplay>
            </dotlottie-player>
        </div>
    </div>
</nav>
