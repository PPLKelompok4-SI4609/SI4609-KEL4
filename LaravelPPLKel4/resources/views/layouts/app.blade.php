<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-blue-100">

    @include('layouts.navbar')

    <main class="container mx-auto py-10 px-4">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Dotlottie script -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <!-- Laravel Echo Script -->
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.0/dist/echo.iife.js"></script>
    <script>
        window.Pusher = require('pusher-js');
        const echo = new Echo({
            broadcaster: 'pusher',
            key: 'e1d4e43e39eb3201b971',  // Your Pusher Key
            cluster: 'ap1',  // Your Pusher Cluster
            encrypted: true,
        });

        // Listen for New Article Published event
        echo.channel('articles')
            .listen('NewArticlePublished', (event) => {
                console.log('New article published:', event.article.title);
                updateNotificationBadge();
                // Optionally, show notification to the user
                showNotification(event.article.title);
            });

        // Update the notification badge
        function updateNotificationBadge() {
            let notificationCount = document.getElementById('notification-count');
            notificationCount.innerText = parseInt(notificationCount.innerText) + 1;
        }

        // Show notification to the user
        function showNotification(title) {
            const notificationElement = document.createElement('div');
            notificationElement.classList.add('bg-blue-600', 'text-white', 'px-4', 'py-2', 'rounded', 'mb-2');
            notificationElement.textContent = 'New article published: ' + title;
            document.getElementById('notification-list').appendChild(notificationElement);
        }
    </script>
</body>
</html>
