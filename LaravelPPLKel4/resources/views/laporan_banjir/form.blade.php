@extends('layouts.app')

@section('title', 'FloodRescue | Form Laporan Banjir')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center" style="color:#2db9f0;">Form Laporan Banjir Darurat</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('laporan-banjir.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <input type="text" name="lokasi" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kontak</label>
            <input type="text" name="kontak" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Kejadian</label>
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
            <button type="submit" class="bg-green-600 hover:bg-green-800 text-white px-6 py-2 rounded-lg transition duration-200">
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

