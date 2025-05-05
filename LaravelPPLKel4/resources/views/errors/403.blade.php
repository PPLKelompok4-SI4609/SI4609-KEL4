@extends('layouts.app')

@section('content')
<div class="mt-20 flex items-center justify-center">
    <div class="bg-white shadow-xl rounded-2xl p-10 text-center max-w-md w-full">
        <div class="text-blue-500 text-6xl font-bold">403</div>
        <h1 class="text-2xl font-semibold mt-4">Akses Ditolak</h1>
        <p class="mt-2 text-gray-600">Kamu tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="{{ url('/') }}"
            class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-full transition duration-200">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection