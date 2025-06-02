@extends('layouts.app')

@section('title', 'FloodRescue | Layanan Pembersihan Rumah Setelah Banjir')

@section('content')
<style>
.hero {
    background-image: url('../../images/bgcs.jpg');
    background-size: cover;
    background-position: center;
    height: 80vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    padding: 0 1rem;
    border-radius: 1rem 1rem 0 0;
}

.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5); /* Overlay gelap */
    z-index: 1;
    border-radius: 1rem 1rem 0 0;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    padding: 1rem;
}

.cta-button {
    display: inline-block;
    margin-top: 1.5rem;
    padding: 0.75rem 1.5rem;
    color: white;
    border-radius: 9999px;
    font-weight: bold;
}
</style>

<div class="container mx-auto rounded-xl shadow-lg">
    <header class="hero">
        <div class="hero-content">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">Layanan Pembersihan Rumah Setelah Banjir</h1>
            <p class="text-lg md:text-xl mb-6">Memulihkan rumah dan area anda setelah kerusakan akibat banjir dengan perawatan ahli dan ketelitian tinggi</p>
            <a href="#services" class="cta-button bg-blue-700 hover:bg-blue-900 transition-transform duration-300 hover:scale-110">Yuk, Bersihkan Rumah Anda Bersama Kami!</a>
        </div>
    </header>

    <section id="about" class="py-16 bg-gray-50 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">Penyedia Layanan Kebersihan Terbaik Nasional</h2>
            <div class="flex justify-center">
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-left list-disc list-inside mb-8 max-w-2xl">
                    <li>Tim Profesional dan Berpengalaman</li>
                    <li>Peralatan dan Produk Berkualitas</li>
                    <li>Pemulihan Cepat dan Efisien</li>
                    <li>Terpercaya dan Terlindungi</li>
                </ul>
            </div>
            <div class="inline-flex items-center justify-center gap-2 text-xl font-semibold">
                <span class="text-blue-700 text-4xl font-bold">20+</span>
                <span>Tahun Pengalaman</span>
            </div>
        </div>
    </section>

    <section id="services" class="py-16 bg-white text-center scroll-mt-36">
        <h2 class="text-2xl font-bold mb-10">Berbagai Layanan Pembersihan untuk Anda</h2>
        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 px-4 max-w-6xl mx-auto">
            <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition-transform duration-300 hover:scale-110">
                <a href="{{ route('cleaning-request.create.with-service', 'home_cleaning') }}">
                    <img src="{{ asset('images/house.png') }}" class="mx-auto mb-4 w-14 h-14">
                    <h3 class="font-semibold text-lg mb-2">Pembersihan Rumah</h3>
                    <p>Restorasi kerusakan banjir profesional untuk rumah.</p>
                </a>
            </div>
            <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition-transform duration-300 hover:scale-110">
                <a href="{{ route('cleaning-request.create.with-service', 'office_cleaning') }}">
                    <img src="{{ asset('images/office-cleaning.png') }}" class="mx-auto mb-4 w-14 h-14">
                    <h3 class="font-semibold text-lg mb-2">Pembersihan Kantor</h3>
                    <p>Layanan pembersihan dan perbaikan banjir untuk bisnis.</p>
                </a>
            </div>
            <div class="bg-gray-100 rounded-lg p-6 shadow hover:shadow-lg transition-transform duration-300 hover:scale-110">
                <a href="{{ route('cleaning-request.create.with-service', 'furniture_cleaning') }}">
                    <img src="{{ asset('images/window-cleaning.png') }}" class="mx-auto mb-4 w-14 h-14">
                    <h3 class="font-semibold text-lg mb-2">Pembersihan Perabotan</h3>
                    <p>Pembersihan khusus untuk perabotan yang rusak akibat banjir.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50 text-center">
        <img src="{{ asset('images/clean-logo.png') }}" class="mx-auto mb-4 w-28 h-28">
        <p class="mb-4 text-gray-700 text-lg">Sudah pesan layanan kami? Yuk cek status dan riwayat pesananmu!</p>
        <a href="{{ route('orders.user.index') }}" 
        class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-10 rounded-full shadow-lg transition-transform duration-300 hover:scale-110">
        Lihat Pesanan Saya
        </a>
    </section>

    <section id="Testimoni" class="bg-blue-900 text-white py-16">
        <h2 class="text-2xl font-bold text-center mb-10">Mereka yang Telah Mempercayai Kami</h2>
        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 px-4 max-w-6xl mx-auto">
            @php
                $testimonis = [
                    ['img' => 'Rio.jpg', 'nama' => 'Rio Ramadhani', 'desc' => 'Setelah banjir besar melanda daerah kami, saya sangat stres melihat kondisi rumah. Tim pembersihan ini luar biasa, mereka datang tepat waktu dan membersihkan rumah saya hingga seperti baru lagi. Sangat profesional!'],
                    ['img' => 'yodha.jpeg', 'nama' => 'Wendy Shakur', 'desc' => 'Banjir membuat kantor kami lumpuh total. Beruntung kami menemukan layanan ini. Mereka tidak hanya membersihkan, tapi juga memastikan semua ruangan steril dan siap digunakan kembali.'],
                    ['img' => 'abid.png', 'nama' => 'Abid Jordy', 'desc' => 'Saya pikir sofa dan kursi kayu saya harus dibuang. Tapi layanan ini ajaib! Furnitur saya tampak baru lagi, bahkan lebih bersih dari sebelumnya.'],
                    ['img' => 'kirana.jpg', 'nama' => 'Kirana Adira', 'desc' => 'Tim pembersihan ini sangat membantu saat rumah saya terendam. Mereka menangani lumpur, bau tidak sedap, dan sangat detail.'],
                    ['img' => 'Suzanaya.jpg', 'nama' => 'Suzanaya Putri', 'desc' => 'Layanan kantor mereka sangat cepat dan efisien. Dalam dua hari, kantor kami bersih, kering, dan siap beroperasi.'],
                    ['img' => 'diva.jpg', 'nama' => 'Ladiva Zahra', 'desc' => 'Furnitur antik saya terkena banjir. Tapi layanan ini membersihkannya dengan hati-hati. Hasilnya sangat memuaskan!']
                ];
            @endphp
            @foreach ($testimonis as $t)
            <div class="bg-white text-gray-800 rounded-xl p-6 shadow-md hover:shadow-2xl hover:scale-105 transform transition duration-300 ease-in-out">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/' . $t['img']) }}" alt="{{ $t['nama'] }}" class="w-12 h-12 rounded-full mr-3 border border-gray-300 object-cover aspect-square">
                    <h3 class="font-semibold text-base">{{ $t['nama'] }}</h3>
                </div>
                <p class="text-sm text-justify">{{ $t['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section id="contact" class="py-16 bg-gray-100 text-center" style="border-radius: 0 0 1rem 1rem;">
        <h2 class="text-2xl font-bold mb-4">Hubungi Kami</h2>
        <p class="mb-6">Segera hubungi kami untuk bantuan pembersihan banjir</p>
        <div class="space-y-2">
            <p class="text-lg">📞 Hotline Darurat: <span class="font-semibold">(123) 456-7890</span></p>
            <p class="text-lg">📧 Email: admin@floodrescue.com</p>
        </div>
    </section>
</div>
@endsection
