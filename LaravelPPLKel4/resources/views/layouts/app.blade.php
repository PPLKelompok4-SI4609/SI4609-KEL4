<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
<<<<<<< Updated upstream
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"/>
=======
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
>>>>>>> Stashed changes
    <style>
        .font-pacifico {
            font-family: "Pacifico", cursive;
        }
    </style>
</head>
<<<<<<< Updated upstream
<body class="bg-white text-gray-900">
    @yield('content')
=======
<body class="min-h-screen bg-blue-100">

    @include('layouts.navbar')

    <main class="container mx-auto py-10 px-4">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Dotlottie script -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <!-- Pusher and Push Notification JavaScript -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- Notifikasi Icon di Navbar -->
    <div id="notification-icon" class="relative cursor-pointer ml-6">
        <i class="fas fa-bell text-gray-700 text-xl"></i> <!-- Icon Bell -->
        <span id="notification-count" class="absolute top-0 right-0 bg-red-500 text-white rounded-full text-xs px-2 py-1 hidden">0</span> <!-- Badge Counter -->
    </div>

    <script>
        // Inisialisasi Pusher
        Pusher.logToConsole = true;

        var pusher = new Pusher('e1d4e43e39eb3201b971', {
            cluster: 'ap1'
        });

        // Menyubscribe ke kanal berdasarkan ID pengguna
        var channel = pusher.subscribe('floodrescue');
 // Sesuaikan dengan pengguna yang login
        channel.bind('FloodRescueNotification', function(data) {
            // Update jumlah notifikasi di navbar
            var notificationCount = document.getElementById('notification-count');
            notificationCount.classList.remove('hidden');
            notificationCount.innerText = parseInt(notificationCount.innerText) + 1; // Tambah jumlah notifikasi

            // Tampilkan push notification browser
            if (Notification.permission === "granted") {
                new Notification(data.title, {
                    body: data.message,
                    icon: '/images/bell.png', // Path gambar ikon
                });
            }

            // Tampilkan notifikasi di UI (di dalam halaman)
            showNotification(data.message);
        });

        // Jika izin belum diberikan, minta izin kepada pengguna
        if (Notification.permission !== "granted") {
            Notification.requestPermission().then(function(permission) {
                if (permission === "granted") {
                    console.log("Notifikasi diizinkan!");
                } else {
                    console.log("Notifikasi ditolak");
                }
            });
        }

        // Fungsi untuk menampilkan notifikasi di UI
        function showNotification(message) {
            const notificationElement = document.getElementById('notification');
            const notificationMessage = document.getElementById('notification-message');
            notificationMessage.innerText = message;

            // Tampilkan notifikasi
            notificationElement.classList.remove('hidden');
            notificationElement.classList.add('show');

            // Hide notification after 5 seconds
            setTimeout(function() {
                notificationElement.classList.remove('show');
                notificationElement.classList.add('hidden');
            }, 5000);
        }

        // Fungsi untuk menutup notifikasi
        function closeNotification() {
            const notificationElement = document.getElementById('notification');
            notificationElement.classList.remove('show');
            notificationElement.classList.add('hidden');
        }

        // Event listener untuk ikon notifikasi
        document.getElementById('notification-icon').addEventListener('click', function() {
            // Tampilkan notifikasi atau lakukan aksi lainnya
            alert('Ada artikel baru!');
        });
    </script>

>>>>>>> Stashed changes
</body>
</html>