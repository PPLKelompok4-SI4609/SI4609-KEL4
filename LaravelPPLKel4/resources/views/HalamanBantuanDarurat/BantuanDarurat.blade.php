@extends('layouts.app')

@section('title', 'Bantuan Darurat')

@section('content')
<link rel="stylesheet" href="/css/halamanbantuan.css">
<div class="bg-white rounded-xl shadow-md p-10 text-center mb-6">
    <h1 class="text-4xl font-bold mb-4">Halaman Bantuan Darurat</h1>
    <p class="text-lg text-gray-600 mb-4">
        Saat bencana datang, setiap detik sangat berarti. Halaman ini menyediakan informasi kontak penting yang siap membantu Anda dalam keadaan darurat, khususnya terkait bencana banjir.
    </p>
    <hr class="border-gray-300 mb-4">
    <p class="text-gray-500 mb-4">
        Kami menghadirkan daftar instansi seperti polisi, tim SAR, pemadam kebakaran, hingga layanan kesehatan yang dapat Anda hubungi dengan mudah dan cepat.
    </p>
    <p class="text-gray-500 mb-6">
        Seluruh informasi dirancang secara responsif agar mudah diakses melalui berbagai perangkat, kapan pun dan di mana pun Anda berada.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Polrestabes Bandung -->
  <div class="profile-card">
    <div class="image">
      <img src="/images/polrestabesbandung.jpeg" alt="Polisi Bandung" class="profile-pic">
    </div>
    <div class="data">
      <h2>Polrestabes Bandung</h2>
      <span>Pelayanan Kepolisian Kota Bandung</span>
    </div>
    <p class="description">
      Tanggap laporan pengaduan, keamanan lingkungan, dan bantuan evakuasi di seluruh wilayah Bandung.
    </p>
    <div class="buttons">
      <a href="https://wa.me/6281222223333" target="_blank" class="btn">WhatsApp</a>
      <a href="https://instagram.com/polrestabesbandung" target="_blank" class="btn">Instagram</a>
    </div>
  </div>

  <!-- BPBD Kota Bandung -->
  <div class="profile-card">
    <div class="image">
    <img src="/images/BPBD Kota Bandung.jpeg" alt="BPBD Bandung" class="profile-pic">
    </div>
    <div class="data">
      <h2>BPBD Kota Bandung</h2>
      <span>Badan Penanggulangan Bencana Daerah</span>
    </div>
    <p class="description">
      Siaga 24 jam untuk evakuasi warga terdampak, bantuan logistik, dan informasi banjir Kota Bandung.
    </p>
    <div class="buttons">
      <a href="https://wa.me/6285770000999" target="_blank" class="btn">WhatsApp</a>
      <a href="https://instagram.com/bpbdbandung" target="_blank" class="btn">Instagram</a>
    </div>
  </div>

  <!-- Damkar Kota Bandung -->
  <div class="profile-card">
    <div class="image">
    <img src="/images/Damkar Kota Bandung.jpeg" alt="Damkar Bandung" class="profile-pic">
    </div>
    <div class="data">
      <h2>Damkar Kota Bandung</h2>
      <span>Dinas Kebakaran & Penanggulangan Bencana</span>
    </div>
    <p class="description">
      Membantu evakuasi banjir, penanganan korsleting listrik, dan evakuasi warga di lokasi darurat.
    </p>
    <div class="buttons">
      <a href="tel:113" class="btn">Hubungi 113</a>
      <a href="https://instagram.com/damkarkotabandung" target="_blank" class="btn">Instagram</a>
    </div>
  </div>

  <!-- Puskesmas Dago -->
  <div class="profile-card">
    <div class="image">
    <img src="images/Puskesmas Dago.jpg" alt="Puskesmas Dago" class="profile-pic">
    </div>
    <div class="data">
      <h2>Puskesmas Dago</h2>
      <span>Layanan Medis Darurat</span>
    </div>
    <p class="description">
      Menyediakan layanan pertolongan pertama, pemeriksaan kesehatan, dan bantuan medis banjir.
    </p>
    <div class="buttons">
      <a href="https://wa.me/6281322334455" target="_blank" class="btn">WhatsApp</a>
      <a href="https://instagram.com/puskesmasdago" target="_blank" class="btn">Instagram</a>
    </div>
  </div>

  <!-- PLN Bandung -->
  <div class="profile-card">
    <div class="image">
      <img src="/images/PLN UP3 Bandung.jpg" alt="PLN Bandung" class="profile-pic">
    </div>
    <div class="data">
      <h2>PLN UP3 Bandung</h2>
      <span>Gangguan Listrik & Evakuasi Instalasi</span>
    </div>
    <p class="description">
      Siap tangani gangguan listrik saat banjir dan potensi bahaya dari kabel/panel listrik terbuka.
    </p>
    <div class="buttons">
      <a href="https://wa.me/6281234500011" target="_blank" class="btn">WhatsApp</a>
      <a href="https://instagram.com/pln_bandung" target="_blank" class="btn">Instagram</a>
    </div>
  </div>

  <!-- Relawan Bandung Bergerak -->
  <div class="profile-card">
    <div class="image">
    <img src="/images/Bandung Bergerak.jpeg" alt="Relawan Bandung" class="profile-pic">
    </div>
    <div class="data">
      <h2>Bandung Bergerak</h2>
      <span>Komunitas Relawan Banjir</span>
    </div>
    <p class="description">
      Memberikan bantuan makanan, pakaian, tempat penampungan sementara, dan tenaga relawan.
    </p>
    <div class="buttons">
      <a href="https://wa.me/6287888999911" target="_blank" class="btn">WhatsApp</a>
      <a href="https://instagram.com/bandungbergerak" target="_blank" class="btn">Instagram</a>
    </div>
  </div>
</div>


@endsection
