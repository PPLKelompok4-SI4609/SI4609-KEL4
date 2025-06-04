@extends('layouts.app')

@section('title', 'FloodRescue | 403 Forbidden')

@section('content')
<div class="mt-10 flex items-center justify-center">
    <div class="bg-white shadow-xl rounded-2xl p-10 text-center max-w-md w-full">
        <div class="justify-center flex mb-6">
            <dotlottie-player
                src="https://lottie.host/4bd9c78f-a468-4b16-bdea-ada2f9458408/W3eeYUtIVl.lottie"
                background="transparent"
                speed="1"
                style="width: 100px; height: 100px"
                loop
                autoplay>
            </dotlottie-player>
        </div>
        <div class="text-blue-500 text-6xl font-bold">403</div>
        <h1 class="text-2xl font-semibold mt-4">Akses Ditolak</h1>
        <p class="mt-2 text-gray-600">Kamu tidak memiliki izin untuk mengakses halaman ini.</p>
        @php
            $role = Auth::check() ? Auth::user()->role : null;
            $redirectUrl = '/';
            if ($role === 'admin') {
                $redirectUrl = '/admin/dashboard';
            }
        @endphp

        <a href="{{ url($redirectUrl) }}"
            class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-full transition duration-200">
            Kembali ke {{ $role === 'admin' ? 'Dashboard' : 'Home' }}
        </a>
    </div>
</div>
@endsection