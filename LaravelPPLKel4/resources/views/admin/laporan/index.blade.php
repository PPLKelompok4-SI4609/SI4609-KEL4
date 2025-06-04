@extends('admin.layouts.app')

@section('title', 'FloodRescue | Kelola Laporan')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-blue-600">Kelola Laporan Banjir</h1>
</div>

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

@if ($laporans->isEmpty())
    <div class="text-center py-10 text-gray-500">
        Belum ada laporan yang masuk.
    </div>
@else
    <div class="grid gap-6">
        @foreach ($laporans as $laporan)
            <div x-data="{ open: false }" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    
                    <div class="flex items-start gap-4">
                        @if ($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kejadian" class="w-32 h-24 object-cover rounded-lg">
                        @endif

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $laporan->nama }}</h2>
                            <p class="text-sm text-gray-600 mt-1">Lokasi: {{ $laporan->lokasi }}</p>
                            <p class="text-sm text-gray-600 mt-1">Kontak: {{ $laporan->kontak }}</p>
                            <p class="mt-2 mb-4 text-sm font-semibold">
                                Status: 
                                <span class="
                                    px-2 py-1 rounded 
                                    @if($laporan->status == 'Dikirim') bg-blue-100 text-blue-700 
                                    @elseif($laporan->status == 'Diproses') bg-yellow-100 text-yellow-700 
                                    @elseif($laporan->status == 'Ditolak') bg-red-100 text-red-700 
                                    @elseif($laporan->status == 'Selesai') bg-green-100 text-green-700 
                                    @endif
                                ">
                                    {{ $laporan->status }}
                                </span>
                            </p>
                            <p class="mt-3 text-gray-700 line-clamp-2">{{ $laporan->deskripsi }}</p>
                            <button 
                                @click="open = true" 
                                class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm"
                            >
                                Lihat Detail
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                        @if ($laporan->status == 'Diproses')
                            <a href="https://api.whatsapp.com/send?phone=6281316163355" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                Hubungi Tim Basarnas Bandung
                            </a>
                            <a href="https://api.whatsapp.com/send?phone=6282123882676" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                Hubungi Tim Relawan Nusantara
                            </a>
                        @endif

                        @if (!in_array($laporan->status, ['Ditolak', 'Selesai']))
                            <form method="POST" action="{{ route('admin.laporan.updateStatus', $laporan->id) }}" class="flex flex-col items-end gap-2">
                                @csrf
                                @method('PUT')

                                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="Dikirim" {{ $laporan->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>

                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                    Update
                                </button>
                            </form>
                        @endif

                        @if (in_array($laporan->status, ['Ditolak', 'Selesai']))
                            <form method="POST" action="{{ route('admin.laporan.destroy', $laporan->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                    Hapus Laporan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div 
                    x-show="open" 
                    x-cloak 
                    x-transition 
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                >
                    <div 
                        @click.away="open = false" 
                        class="bg-white w-11/12 max-w-md p-6 rounded-xl shadow-xl relative"
                    >
                        <button 
                            @click="open = false" 
                            class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-xl"
                        >
                            &times;
                        </button>
                        <h3 class="text-xl font-bold text-blue-600 mb-4">Detail Laporan</h3>
                        <div class="text-sm text-gray-700 space-y-2">
                            <p><strong>Nama:</strong> {{ $laporan->nama }}</p>
                            <p><strong>Lokasi:</strong> {{ $laporan->lokasi }}</p>
                            <p><strong>Kontak:</strong> {{ $laporan->kontak }}</p>
                            <p><strong>Status:</strong> {{ $laporan->status }}</p>
                            <p><strong>Deskripsi:</strong> {{ $laporan->deskripsi }}</p>
                            @if ($laporan->foto)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto" class="w-full rounded-lg shadow">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
