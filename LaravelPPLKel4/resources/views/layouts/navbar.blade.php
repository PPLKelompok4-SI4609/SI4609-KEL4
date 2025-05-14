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

        <!-- Lottie Icon dan Notifikasi Icon dekat -->
        <div class="flex items-center gap-4"> <!-- Menambahkan gap kecil antara ikon -->
            <!-- Lottie Icon -->
            <dotlottie-player
                src="https://lottie.host/06e4e57a-f9d6-443c-ab07-6de34da61307/DHBDrVzYes.lottie"
                background="transparent"
                speed="1"
                style="width: 30px; height: 30px;"
                loop
                autoplay>
            </dotlottie-player>

            <!-- Notifikasi Icon -->
            <div id="notification-icon" class="relative cursor-pointer">
                <i class="fas fa-bell text-gray-700 text-xl"></i> <!-- Font Awesome Bell Icon -->
                <span id="notification-count" class="absolute top-0 right-0 bg-red-500 text-white rounded-full text-xs px-2 py-1 hidden">0</span> <!-- Badge Counter -->
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher-js/7.0.3/pusher.min.js"></script>

<script>
    // Menangani klik pada ikon notifikasi
    document.getElementById('notification-icon').addEventListener('click', () => {
        const dropdown = document.getElementById('notification-dropdown');
        dropdown.classList.toggle('hidden');  // Toggle visibilitas dropdown
    });

    // Mendengarkan event "NewArticlePublished" menggunakan Laravel Echo
    window.Echo.channel('articles')
        .listen('NewArticlePublished', (event) => {
            console.log('New article published:', event.article.title); // Debug: log artikel yang diterima

            // Menampilkan jumlah notifikasi pada ikon
            updateNotificationCount(event.articleCount);

            // Menampilkan daftar notifikasi dalam dropdown
            loadNotifications(event.notifications);
        });

    // Fungsi untuk memperbarui jumlah notifikasi
    function updateNotificationCount(count) {
        const notificationCount = document.getElementById('notification-count');
        notificationCount.innerText = count;
    }

    // Fungsi untuk menampilkan daftar notifikasi dalam dropdown
    function loadNotifications(notifications) {
        const notificationList = document.getElementById('notification-list');
        notificationList.innerHTML = '';  // Kosongkan list sebelum mengisi

        notifications.forEach(notification => {
            const li = document.createElement('li');
            li.classList.add('p-2', 'hover:bg-gray-100');
            li.innerHTML = `<a href="${notification.link}" class="text-sm text-gray-700">${notification.title}</a>`;
            notificationList.appendChild(li);
        });
    }
</script>

