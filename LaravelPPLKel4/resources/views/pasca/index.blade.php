@extends('layouts.app')

@section('title', 'FloodRescue | Layanan Pasca Banjir')

@section('content')
<!-- Hero Section -->
<header class="relative bg-cover bg-center h-[80vh] flex items-center justify-center text-center text-white mt-16" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/image/bgcs.jpg')">
    <div class="max-w-2xl px-4">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">Layanan Pembersihan Rumah Setelah Banjir</h1>
        <p class="text-lg mb-8">Memulihkan rumah dan area anda setelah kerusakan akibat banjir dengan perawatan ahli dan ketelitian tinggi</p>
        <a href="#services" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
            Yuk, Bersihkan Rumah Anda Bersama Kami!
        </a>
    </div>
</header>

<!-- About Section -->
<section id="about" class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-8">Penyedia Layanan Kebersihan Terbaik Nasional</h2>
        <ul class="mb-10 space-y-4 text-lg text-gray-700">
            <li>✓ Tim Profesional dan Berpengalaman</li>
            <li>✓ Peralatan dan Produk Berkualitas</li>
            <li>✓ Pemulihan Cepat dan Efisien</li>
            <li>✓ Terpercaya dan Terlindungi</li>
        </ul>
        <div class="inline-block bg-blue-500 text-white rounded-xl px-10 py-8">
            <span class="block text-4xl font-bold">20+</span>
            <span class="block mt-2">Tahun Pengalaman</span>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Berbagai Layanan Pembersihan untuk Anda</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $services = [
                    ['icon' => 'house.png', 'title' => 'Pembersihan Rumah', 'desc' => 'Restorasi kerusakan banjir profesional untuk rumah'],
                    ['icon' => 'office-cleaning.png', 'title' => 'Pembersihan Kantor', 'desc' => 'Layanan pembersihan dan perbaikan banjir untuk bisnis'],
                    ['icon' => 'window-cleaning.png', 'title' => 'Pembersihan Perabotan', 'desc' => 'Pembersihan khusus untuk perabotan yang rusak akibat banjir'],
                ];
            @endphp
            @foreach ($services as $service)
            <div class="bg-white rounded-xl shadow-md text-center p-8 hover:-translate-y-2 transition">
                <img src="{{ asset('images/' . $service['icon']) }}" alt="{{ $service['title'] }}" class="mx-auto mb-4 w-16 h-16">
                <h3 class="text-xl font-semibold mb-2">{{ $service['title'] }}</h3>
                <p class="text-gray-600">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni Section -->
<section id="Testimoni" class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Mereka yang Telah Mempercayai Kami!</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $testimonials = [
                    ['img' => 'Rio.jpg', 'name' => 'Rio Ramadhani', 'text' => 'Setelah banjir besar melanda daerah kami, saya sangat stres melihat kondisi rumah. Tim pembersihan ini luar biasa, mereka datang tepat waktu dan membersihkan rumah saya hingga seperti baru lagi. Sangat profesional!'],
                    ['img' => 'yodha.jpeg', 'name' => 'Wendy Shakur', 'text' => 'Banjir membuat kantor kami lumpuh total. Beruntung kami menemukan layanan ini. Mereka tidak hanya membersihkan, tapi juga memastikan semua ruangan steril dan siap digunakan kembali. Sangat direkomendasikan untuk pemilik usaha!'],
                    ['img' => 'abid.png', 'name' => 'Abid Jordy', 'text' => 'Saya pikir sofa dan kursi kayu saya harus dibuang setelah terkena banjir. Tapi layanan pembersihan furnitur ini benar-benar ajaib! Furnitur saya tampak baru lagi, bahkan lebih bersih dari sebelumnya.'],
                    ['img' => 'kirana.jpg', 'name' => 'Kirana Adira', 'text' => 'Tim pembersihan ini sangat membantu ketika rumah saya terendam banjir. Mereka menangani lumpur, bau tidak sedap, bahkan memperhatikan detail kecil. Hasilnya rumah saya kembali nyaman untuk ditinggali.'],
                    ['img' => 'Suzanaya.jpg', 'name' => 'Suzanaya Putri', 'text' => 'Layanan pembersihan kantor mereka sangat cepat dan efisien. Dalam waktu kurang dari dua hari, kantor kami kembali bersih, kering, dan siap beroperasi. Timnya ramah dan sangat profesional'],
                    ['img' => 'diva.jpg', 'name' => 'Ladiva Zahra', 'text' => 'Furnitur antik saya terkena banjir, dan saya sempat putus asa. Tapi berkat layanan ini, kayu dan kain pelapisnya dibersihkan dengan hati-hati. Hasilnya benar-benar memuaskan. Sangat berterima kasih!'],
                ];
            @endphp
            @foreach ($testimonials as $t)
            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:-translate-y-2 transition">
                <img src="{{ asset('images/' . $t['img']) }}" alt="{{ $t['name'] }}" class="w-16 h-16 rounded-full object-cover mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2">{{ $t['name'] }}</h3>
                <p class="text-gray-600 text-sm">{{ $t['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 text-center bg-white">
    <h2 class="text-3xl font-bold mb-4">Hubungi Kami</h2>
    <p class="text-gray-700 mb-6">Segera hubungi kami untuk bantuan pembersihan banjir</p>
    <div class="space-y-4 text-lg">
        <p>📞 Hotline Darurat: (123) 456-7890</p>
        <p>📧 Email: info@floodrescue.com</p>
    </div>
</section>
@endsection
