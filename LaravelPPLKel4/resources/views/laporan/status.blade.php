@extends('layouts.app')

@section('title', 'FloodRescue | Status Laporan')

@section('content')
<div class="flex justify-center gap-4 mb-8">
    <a href="{{ route('laporan.create') }}"
       class="px-4 py-2 rounded-md text-sm font-semibold transition
       {{ request()->routeIs('laporan.create') ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-300' }}">
        Form Laporan
    </a>
    <a href="{{ route('laporan.status') }}"
       class="px-4 py-2 rounded-md text-sm font-semibold transition
       {{ request()->routeIs('laporan.status') ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-300' }}">
        Status Laporan
    </a>
</div>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-md">
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold text-gray-800">Status Laporan Banjir</h1>
    </div>

    @if (session('status'))
        <div class="bg-green-50 border border-green-300 text-green-700 text-sm p-3 rounded-md mb-6">
            {{ session('status') }}
        </div>
    @endif

    @if ($laporans->isEmpty())
        <p class="text-center text-gray-500 text-sm">Belum ada laporan yang dikirim.</p>
    @else
        <div class="grid gap-6">
            @foreach ($laporans as $laporan)
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <div class="flex-1 space-y-2">
                            <h2 class="text-lg font-bold text-gray-800">{{ $laporan->nama }}</h2>
                            <p class="text-sm text-gray-600">Lokasi: <span class="font-medium">{{ $laporan->lokasi }}</span></p>
                            <p class="text-sm text-gray-600">Kontak: <span class="font-medium">{{ $laporan->kontak }}</span></p>

                            <p class="text-sm">
                                Status:
                                <span class="
                                    inline-block px-2 py-1 rounded text-white text-xs font-semibold
                                    @if($laporan->status == 'Dikirim') bg-blue-500
                                    @elseif($laporan->status == 'Diproses') bg-yellow-500
                                    @elseif($laporan->status == 'Ditolak') bg-red-500
                                    @elseif($laporan->status == 'Selesai') bg-green-500
                                    @endif
                                ">
                                    {{ $laporan->status }}
                                </span>
                            </p>

                            <p class="text-xs mt-1 text-gray-700 italic">
                                @if ($laporan->status == 'Dikirim')
                                    Laporan Anda telah berhasil dikirim ke FloodRescue.
                                @elseif ($laporan->status == 'Diproses')
                                    Mohon bersabar, pihak FloodRescue sedang menghubungi tim relawan.
                                @elseif ($laporan->status == 'Ditolak')
                                    Maaf, laporan Anda belum sesuai dengan ketentuan kami.
                                @elseif ($laporan->status == 'Selesai')
                                    Semoga Anda dalam keadaan baik-baik saja.
                                @endif
                            </p>

                            <p class="text-sm text-black mt-2 text-justify">{{ $laporan->deskripsi }}</p>
                        </div>
                        @if ($laporan->foto)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kejadian"
                                    class="w-44 h-36 object-cover rounded-md border border-gray-200 shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
