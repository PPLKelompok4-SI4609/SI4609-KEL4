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
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    
                    <div class="flex items-start gap-4">
                        @if ($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kejadian" class="w-32 h-24 object-cover rounded-lg">
                        @endif

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $laporan->nama }}</h2>
                            <p class="text-sm text-gray-600 mt-1">Lokasi: {{ $laporan->lokasi }}</p>
                            <p class="text-sm text-gray-600 mt-1">Kontak: {{ $laporan->kontak }}</p>
                            <p class="mt-3 text-gray-700">{{ $laporan->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Update Status Form -->
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

                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
