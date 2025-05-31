@extends($layout)

@section('title', 'FloodRescue | Bantuan Darurat')

@section('content')
<div class="bg-white rounded-xl shadow-md p-10 text-center mb-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Halaman Bantuan Darurat</h1>
    <p class="text-lg text-gray-600 mb-2">
        Saat bencana datang, setiap detik sangat berarti. Halaman ini menyediakan informasi kontak penting yang siap membantu Anda dalam keadaan darurat, khususnya terkait bencana banjir.
    </p>
    <p class="text-gray-500 mb-2">
        Kami menghadirkan daftar instansi seperti polisi, tim SAR, pemadam kebakaran, hingga layanan kesehatan yang dapat Anda hubungi dengan mudah dan cepat.
    </p>
    <p class="text-gray-500">
        Seluruh informasi dirancang secara responsif agar mudah diakses melalui berbagai perangkat, kapan pun dan di mana pun Anda berada.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @php
        $emergencies = [
            [
                'name' => 'Polrestabes Bandung',
                'role' => 'Pelayanan Kepolisian Kota Bandung',
                'desc' => 'Tanggap laporan pengaduan, keamanan lingkungan, dan bantuan evakuasi di seluruh wilayah Bandung.',
                'img' => '/images/polrestabesbandung.jpeg',
                'wa' => '6281222223333',
                'ig' => 'polrestabesbandung',
                'tel' => null
            ],
            [
                'name' => 'BPBD Kota Bandung',
                'role' => 'Badan Penanggulangan Bencana Daerah',
                'desc' => 'Siaga 24 jam untuk evakuasi warga terdampak, bantuan logistik, dan informasi banjir Kota Bandung.',
                'img' => '/images/BPBD Kota Bandung.jpeg',
                'wa' => '6285770000999',
                'ig' => 'bpbdbandung',
                'tel' => null
            ],
            [
                'name' => 'Damkar Kota Bandung',
                'role' => 'Dinas Kebakaran & Penanggulangan Bencana',
                'desc' => 'Membantu evakuasi banjir, penanganan korsleting listrik, dan evakuasi warga di lokasi darurat.',
                'img' => '/images/Damkar Kota Bandung.jpeg',
                'wa' => null,
                'ig' => 'damkarkotabandung',
                'tel' => '113'
            ],
            [
                'name' => 'Puskesmas Dago',
                'role' => 'Layanan Medis Darurat',
                'desc' => 'Menyediakan layanan pertolongan pertama, pemeriksaan kesehatan, dan bantuan medis banjir.',
                'img' => 'images/Puskesmas Dago.jpg',
                'wa' => '6281322334455',
                'ig' => 'puskesmasdago',
                'tel' => null
            ],
            [
                'name' => 'PLN UP3 Bandung',
                'role' => 'Gangguan Listrik & Evakuasi Instalasi',
                'desc' => 'Siap tangani gangguan listrik saat banjir dan potensi bahaya dari kabel/panel listrik terbuka.',
                'img' => '/images/PLN UP3 Bandung.jpg',
                'wa' => '6281234500011',
                'ig' => 'pln_bandung',
                'tel' => null
            ],
            [
                'name' => 'Bandung Bergerak',
                'role' => 'Komunitas Relawan Banjir',
                'desc' => 'Memberikan bantuan makanan, pakaian, tempat penampungan sementara, dan tenaga relawan.',
                'img' => '/images/Bandung Bergerak.png',
                'wa' => '6287888999911',
                'ig' => 'bandungbergerak',
                'tel' => null
            ],
        ];
    @endphp

    @foreach ($emergencies as $item)
    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center text-center transition hover:shadow-xl">
        <div class="w-36 h-36 mb-4">
            <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" class="rounded-full w-full h-full object-cover shadow-md">
        </div>
        <h2 class="text-xl font-semibold text-blue-800">{{ $item['name'] }}</h2>
        <p class="text-sm text-gray-600 mt-1">{{ $item['role'] }}</p>
        <p class="text-sm text-gray-500 mt-4">{{ $item['desc'] }}</p>

        <div class="mt-6 flex gap-3 flex-wrap justify-center">
            @if ($item['wa'])
            <a href="https://wa.me/{{ $item['wa'] }}" target="_blank"
               class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-full transition">
               WhatsApp
            </a>
            @endif

            @if ($item['ig'])
            <a href="https://instagram.com/{{ $item['ig'] }}" target="_blank"
               class="bg-pink-500 hover:bg-pink-600 text-white text-sm font-medium px-4 py-2 rounded-full transition">
               Instagram
            </a>
            @endif

            @if ($item['tel'])
            <a href="tel:{{ $item['tel'] }}"
               class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-full transition">
               Hubungi {{ $item['tel'] }}
            </a>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
