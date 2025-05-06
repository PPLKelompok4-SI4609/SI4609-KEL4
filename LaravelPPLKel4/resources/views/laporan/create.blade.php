@extends('layouts.app')

@section('title', 'FloodRescue | Form Laporan Banjir')

@section('content')
<style>
    .input-style {
        @apply w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400;
    }
</style>

<div class="flex justify-center gap-4 mb-6">
    <a href="{{ route('laporan.create') }}"
       class="px-4 py-2 rounded-md text-sm font-medium transition
       {{ request()->routeIs('laporan.create') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-200' }}">
        Form Laporan
    </a>
    <a href="{{ route('laporan.status') }}"
       class="px-4 py-2 rounded-md text-sm font-medium transition
       {{ request()->routeIs('laporan.status') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-200' }}">
        Status Laporan
    </a>
</div>

<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-md space-y-6">
    <h1 class="text-2xl font-bold text-gray-800 text-center">Form Laporan Banjir</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required></textarea>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Kontak</label>
            <input type="text" name="kontak" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto Kejadian</label>
            <div id="imagePreview" class="mb-3 border rounded-lg p-2 text-center text-gray-500 bg-gray-50">
                <p>No image selected</p>
            </div>
            <input 
                type="file" 
                name="foto" 
                accept="image/*" 
                onchange="previewImage(event)"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" 
                required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-6 py-2 rounded-md transition">
                Kirim Laporan
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview');
            output.innerHTML = `<img src="${reader.result}" alt="Preview" class="mx-auto rounded-lg shadow w-full max-w-xs h-auto">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection

