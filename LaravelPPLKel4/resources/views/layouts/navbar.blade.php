<nav class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2 text-xl font-bold text-blue-600 hover:text-blue-700 transition">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            FloodRescue
        </a>

        <!-- Tombol hamburger -->
        <div class="md:hidden">
            <button id="navbar-toggle" class="text-gray-700 focus:outline-none focus:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <ul id="navbar-menu"
            class="hidden md:flex flex-col md:flex-row absolute md:static top-16 left-0 w-full md:w-auto bg-white md:bg-transparent space-y-4 md:space-y-0 md:space-x-6 px-6 md:px-0 text-gray-700 font-medium shadow md:shadow-none z-50">
            <li><a href="#" class="hover:text-blue-600 transition">Donasi & Bantuan</a></li>
            <li>
                <a href="/pasca-banjir"
                    class="{{ Request::is('pasca-banjir') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    Layanan Pasca Banjir
                </a>
            </li>
            <li>
                <a href="/laporan-banjir"
                    class="{{ Request::is('laporan-banjir') || Request::is('status-laporan') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
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

        <!-- Lottie -->
        <div class="hidden md:flex items-center">
            <dotlottie-player src="https://lottie.host/06e4e57a-f9d6-443c-ab07-6de34da61307/DHBDrVzYes.lottie"
                background="transparent" speed="1" style="width: 30px; height: 30px;" loop autoplay>
            </dotlottie-player>
        </div>
    </div>
</nav>

<script>
    // Toggle navbar menu
    const toggleBtn = document.getElementById('navbar-toggle');
    const menu = document.getElementById('navbar-menu');

    toggleBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
