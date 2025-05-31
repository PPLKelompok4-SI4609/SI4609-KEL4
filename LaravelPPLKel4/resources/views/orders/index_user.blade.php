@extends('layouts.app')

@section('title', 'FloodRescue | Daftar Pesanan Anda')

@section('content')
<div class="bg-gray-50 flex flex-col items-center justify-center py-12 px-6 sm:px-10 max-w-7xl mx-auto rounded-lg shadow-md">
  <div class="w-full max-w-5xl">

    <!-- Header -->
    <div class="mb-8 text-center">
      <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">Daftar Pesanan Anda</h1>
      <p class="mt-2 text-gray-500">Pantau layanan kebersihan yang telah Anda pesan.</p>
    </div>

    <!-- Daftar Pesanan -->
    @if(count($orders) > 0)
      @foreach($orders as $order)
        <div class="bg-white rounded-xl shadow-md mb-6 transition hover:shadow-lg">
          <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 gap-4">
            
            <!-- Info Order -->
            <div class="flex items-center gap-4">
              <div class="bg-blue-100 p-3 rounded-lg text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 256 256">
                  <path d="M174,47.75a254.19,254.19,0,0,0-41.45-38.3,8,8,0,0,0-9.18,0A254.19,254.19,0,0,0,82,47.75C54.51,79.32,40,112.6,40,144a88,88,0,0,0,176,0C216,112.6,201.49,79.32,174,47.75ZM128,216a72.08,72.08,0,0,1-72-72c0-57.23,55.47-105,72-118,16.53,13,72,60.75,72,118A72.08,72.08,0,0,1,128,216Z"/>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-800">Order #{{ $order->id }}</h3>
                <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</p>
              </div>
            </div>

            <!-- Info Harga & Tipe -->
            <div class="text-right">
              <p class="text-xl font-bold text-blue-700">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
              <p class="text-sm text-gray-500">
                {{ ucwords(str_replace('_', ' ', $order->service_type)) }}
              </p>
              <a href="{{ route('cleaning-request.confirmation', $order->id) }}" 
                 class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-800 font-medium transition">
                Lihat Detail
              </a>
            </div>

          </div>
        </div>
      @endforeach

    <!-- Jika Tidak Ada Pesanan -->
    @else
      <div class="bg-white rounded-xl shadow-md p-10 text-center">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Belum Ada Pesanan</h2>
        <p class="text-gray-500 mb-6">
          Yuk, pesan layanan pembersihan sekarang dan pulihkan rumah Anda dari dampak banjir!
        </p>
        <a href="{{ route('cleaning-request.create') }}" 
           class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full transition duration-300">
          Pesan Layanan Sekarang
        </a>
      </div>
    @endif

  </div>
</div>
@endsection
