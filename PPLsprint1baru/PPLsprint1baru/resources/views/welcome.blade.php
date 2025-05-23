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

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1>Layanan Pembersihan Rumah Setelah Banjir</h1>
            <p>Memulihkan rumah dan area anda setelah kerusakan akibat banjir dengan perawatan ahli dan ketelitian tinggi</p>
            <a href="#services" class="cta-button">Yuk, Bersihkan Rumah Anda Bersama Kami!</a>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="about-content">
            <h2>Penyedia Layanan Kebersihan Terbaik Nasional</h2>
            <ul class="features">
                <li>✓ Tim Profesional dan Berpengalaman</li>
                <li>✓ Peralatan dan Produk Berkualitas</li>
                <li>✓ Pemulihan Cepat dan Efisien</li>
                <li>✓ Terpercaya dan Terlindungi</li>
            </ul>
            <div class="experience">
                <span class="years">20+</span>
                <span class="text">Tahun Pengalaman</span>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <h2>Berbagai Layanan Pembersihan untuk Anda</h2>
        <div class="services-grid">
            <div class="service-card">
                <a href="{{ route('cleaning-request.create.with-service', 'home_cleaning') }}">
                    <img src="{{ asset('image/house.png') }}" width="50" height="50">
                    <h3>Pembersihan Rumah</h3>
                    <p>Restorasi kerusakan banjir profesional untuk rumah</p>
                </a>
            </div>
            <div class="service-card">
                <a href="{{ route('cleaning-request.create.with-service', 'office_cleaning') }}">
                    <img src="{{ asset('image/office-cleaning.png') }}" width="50" height="50">
                    <h3>Pembersihan Kantor</h3>
                    <p>Layanan pembersihan dan perbaikan banjir untuk bisnis</p>
                </a>
            </div>
            <div class="service-card">
                <a href="{{ route('cleaning-request.create.with-service', 'furniture_cleaning') }}">
                    <img src="{{ asset('image/window-cleaning.png') }}" width="50" height="50">
                    <h3>Pembersihan Perabotan</h3>
                    <p>Pembersihan khusus untuk perabotan yang rusak akibat banjir</p>
                </a>
            </div>
        </div>

    <!-- Testimoni Section -->
    <section id="Testimoni" class="Testimoni">
        <h2>Mereka yang Telah Mempercayai Kami !</h2>
        <div class="Testimoni-grid">
            <div class="Testimoni-card">
                <img src="{{ asset('image/Rio.jpg') }}" width="50" height="50">
                <h3>Rio Ramadhani</h3>
                <p>Setelah banjir besar melanda daerah kami, saya sangat stres melihat kondisi rumah. Tim pembersihan ini luar biasa, mereka datang tepat waktu dan membersihkan rumah saya hingga seperti baru lagi. Sangat profesional!</p>
            </div>
            <div class="Testimoni-card">
                <img src="{{ asset('image/yodha.jpeg') }}" width="50" height="50">
                <h3>Wendy Shakur</h3>
                <p>Banjir membuat kantor kami lumpuh total. Beruntung kami menemukan layanan ini. Mereka tidak hanya membersihkan, tapi juga memastikan semua ruangan steril dan siap digunakan kembali. Sangat direkomendasikan untuk pemilik usaha!</p>
            </div>
            <div class="Testimoni-card">
                <img src="{{ asset('image/abid.png') }}" width="50" height="50">
                <h3>Abid Jordy</h3>
                <p>Saya pikir sofa dan kursi kayu saya harus dibuang setelah terkena banjir. Tapi layanan pembersihan furnitur ini benar-benar ajaib! Furnitur saya tampak baru lagi, bahkan lebih bersih dari sebelumnya.</p>
            </div>
            <div class="Testimoni-card">
                <img src="{{ asset('image/kirana.jpg') }}" width="50" height="50">
                <h3>Kirana Adira</h3>
                <p>Tim pembersihan ini sangat membantu ketika rumah saya terendam banjir. Mereka menangani lumpur, bau tidak sedap, bahkan memperhatikan detail kecil. Hasilnya rumah saya kembali nyaman untuk ditinggali.</p>
            </div>
            <div class="Testimoni-card">
                <img src="{{ asset('image/Suzanaya.jpg') }}" width="50" height="50">
                <h3>Suzanaya Putri</h3>
                <p>Layanan pembersihan kantor mereka sangat cepat dan efisien. Dalam waktu kurang dari dua hari, kantor kami kembali bersih, kering, dan siap beroperasi. Timnya ramah dan sangat profesional</p>
            </div>
            <div class="Testimoni-card">
                <img src="{{ asset('image/diva.jpg') }}" width="50" height="50">
                <h3>Ladiva Zahra</h3>
                <p>Furnitur antik saya terkena banjir, dan saya sempat putus asa. Tapi berkat layanan ini, kayu dan kain pelapisnya dibersihkan dengan hati-hati. Hasilnya benar-benar memuaskan. Sangat berterima kasih!</p>
            </div>
        </div>
    </section>
    

    <!-- Contact Section -->
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