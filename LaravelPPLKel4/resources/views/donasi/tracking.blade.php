@extends('layouts.app')

@section('title', 'Tracking Donasi')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <h2 class="text-2xl font-bold text-[#2f7f6f] mb-6">Tracking Donasi Anda</h2>

    <div class="bg-white p-8 rounded-md shadow-md">
        <h3 class="text-xl font-serif font-bold text-[#2f7f6f] mb-4">Rincian Donasi</h3>

        <div class="mb-4">
            <span class="text-sm text-gray-700">Nomor Donasi: </span>
            <span class="font-semibold text-[#2f7f6f]">{{ $donation->id }}</span>
        </div>

        <div class="mb-4">
            <span class="text-sm text-gray-700">Jumlah Donasi: </span>
            <span class="font-semibold text-[#2f7f6f]">Rp. {{ number_format($donation->amount, 0, ',', '.') }}</span>
        </div>

        <div class="mb-4">
            <span class="text-sm text-gray-700">Status Donasi: </span>
            <span class="font-semibold text-[#2f7f6f]">{{ ucfirst($donation->status) }}</span>
        </div>

        @if ($tracking)
            <div class="mb-4">
                <h4 class="text-lg font-semibold text-[#2f7f6f]">Informasi Tracking</h4>
                <p>{{ $tracking->tracking_info }}</p>
            </div>
        @else
            <div class="mb-4">
                <span class="text-sm text-gray-700">Tidak ada informasi tracking saat ini.</span>
            </div>
        @endif

        <a href="{{ route('donasi.index') }}" class="mt-6 inline-block bg-[#2f7f6f] text-white py-2 px-4 rounded-md hover:bg-[#276a5c]">Kembali ke Beranda</a>
    </div>
</main>
@endsection
