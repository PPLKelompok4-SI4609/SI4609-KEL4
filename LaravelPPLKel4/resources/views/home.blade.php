@extends('layouts.app')

@section('title', 'FloodRescue | Home')

@section('content')
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
<div class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto mt-24 px-6">
    <!-- Left Text -->
    <div class="md:w-1/2 space-y-6">
        <h1 class="text-4xl font-bold text-gray-800">FloodRescue</h1>
        <p class="text-gray-600 text-lg text-justify">
            FloodRescue hadir sebagai solusi cepat untuk bantu kamu menghadapi banjir. 
            Dari info prakiraan banjir, nomor darurat, hingga layanan bantuan — semua bisa kamu akses di satu tempat. 
            Karena keselamatanmu adalah prioritas kami.
        </p>
        @if(auth()->check() && session('two_factor_verified'))
            <div class="flex flex-wrap gap-4">
                <a href="/bantuan-darurat" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-2xl transition duration-300">
                    Bantuan Darurat
                </a>
                <a href="/articles" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-2xl transition duration-300">
                    Artikel & Edukasi
                </a>
            </div>
        @endif
    </div>

    <!-- Right Animation -->
    <div class="md:w-1/2 mt-12 md:mt-0 flex justify-center">
        <dotlottie-player 
            src="https://lottie.host/5ed17681-3cca-4432-a60d-227e18f07c09/nfAGfqq1ME.lottie" 
            background="transparent" 
            speed="1" 
            style="width: 300px; height: 300px;" 
            loop 
            autoplay>
        </dotlottie-player>
    </div>
</div>

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
