@extends('admin.layouts.app')

@section('title', 'FloodRescue | Kelola Laporan')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-blue-600">Kelola Laporan Banjir</h1>
</div>

@if(session('success'))
    <div id="success-alert" class="fixed top-14 left-1/2 transform -translate-x-1/2 z-50 w-[90%] max-w-xl px-6 py-4 rounded bg-green-100 text-green-800 shadow-lg transition-opacity duration-500">
        <span>{{ session('success') }}</span>
        <button onclick="closeAlert('success-alert')" class="absolute top-2 right-3 text-green-800 hover:text-green-600 text-lg font-bold">&times;</button>
    </div>
@endif

@if(session('error'))
    <div id="error-alert" class="fixed top-14 left-1/2 transform -translate-x-1/2 z-50 w-[90%] max-w-xl px-6 py-4 rounded bg-red-100 text-red-800 shadow-lg transition-opacity duration-500">
        <span>{{ session('error') }}</span>
        <button onclick="closeAlert('error-alert')" class="absolute top-2 right-3 text-red-800 hover:text-red-600 text-lg font-bold">&times;</button>
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
                            <a href="/bantuan-darurat" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                Hubungi Bantuan Darurat
                            </a>
                        @endif

                        @if (!in_array($laporan->status, ['Ditolak', 'Selesai']))
                            <form method="POST" action="{{ route('admin.laporan.updateStatus', $laporan->id) }}" class="flex flex-col items-end gap-2 w-full">
                                @csrf
                                @method('PUT')

                                <select 
                                    name="status" 
                                    id="status-select-{{ $laporan->id }}"
                                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    onchange="toggleKeterangan(this, {{ $laporan->id }})"
                                >
                                    <option value="Dikirim" {{ $laporan->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>

                                <textarea 
                                    name="keterangan"
                                    id="keterangan-field-{{ $laporan->id }}"
                                    placeholder="Tulis alasan penolakan..."
                                    class="mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm w-full focus:outline-none focus:ring-2 focus:ring-red-400"
                                    style="display: {{ $laporan->status === 'Ditolak' ? 'block' : 'none' }}"
                                >{{ old('keterangan', $laporan->keterangan) }}</textarea>

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

<script>
    function toggleKeterangan(select, id) {
        const field = document.getElementById('keterangan-field-' + id);
        if (select.value === 'Ditolak') {
            field.style.display = 'block';
        } else {
            field.style.display = 'none';
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        ['success-alert', 'error-alert'].forEach(id => {
            const alert = document.getElementById(id);
            if (alert) {
                setTimeout(() => {
                    alert.classList.add('opacity-0');
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            }
        });
    });

    function closeAlert(id) {
        const alert = document.getElementById(id);
        if (alert) {
            alert.classList.add('opacity-0');
            setTimeout(() => alert.remove(), 500);
        }
    }
</script>
@endsection
