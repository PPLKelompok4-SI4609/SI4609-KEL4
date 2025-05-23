<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodRescue - Post-Flood Cleaning Services</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('image/FloodRescueLogo.png') }}" width="50" height="50">
            <span>FloodRescue</span>
        </div>
        <div class="nav-links">
            <a href="#" class="active">Home</a>
            <a href="#services">Services</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Section -->
    <section id="contact" class="contact">
        <h2>Hubungi Kami</h2>
        <p>Segera hubungi kami untuk bantuan pembersihan banjir</p>
        <div class="contact-info">
            <p>📞 Hotline Darurat: (123) 456-7890</p>
            <p>📧 Email: info@floodrescue.com</p>
        </div>
    </section>
</body>
</html>