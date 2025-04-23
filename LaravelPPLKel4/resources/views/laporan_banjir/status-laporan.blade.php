@extends('layouts.app')

@section('title', 'FloodRescue | Status Laporan')

@section('content')
<div class="flex justify-center gap-4 mb-6">
    <a href="{{ route('laporan-banjir.create') }}"
       class="px-4 py-2 rounded-md text-sm font-medium transition
       {{ request()->routeIs('laporan-banjir.create') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
        Form Laporan
    </a>
    <a href="{{ route('laporan-banjir.status') }}"
       class="px-4 py-2 rounded-md text-sm font-medium transition
       {{ request()->routeIs('laporan-banjir.status') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
        Status Laporan
    </a>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-500">Status Laporan Banjir</h1>
    </div>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('status') }}
        </div>
    @endif

    @if ($laporans->isEmpty())
        <p class="text-gray-500">Belum ada laporan yang dikirim.</p>
    @else
        <div class="grid gap-4">
            @foreach ($laporans as $laporan)
                <div class="bg-white border border-gray-200 p-4 rounded-xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $laporan->nama }}</h2>
                            <p class="text-sm text-gray-600">Lokasi: {{ $laporan->lokasi }}</p>
                            <p class="text-sm text-gray-600">Kontak: {{ $laporan->kontak }}</p>
                            <p class="text-gray-600"><strong>Status:</strong> <span class="text-green-600">{{ $laporan->status ?? 'Dikirim' }}</span></p>
                            <p class="text-sm mt-2 text-gray-700">{{ $laporan->deskripsi }}</p>
                        </div>
                        @if ($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-32 h-24 object-cover rounded-md ml-4">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
