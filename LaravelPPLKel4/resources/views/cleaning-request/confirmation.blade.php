@extends('layouts.app')

@section('title', 'FloodRescue | Pesanan Dikonfirmasi')

@section('content')
<div class="bg-gray-50 flex flex-col justify-center py-12 px-10 max-w-lg mx-auto rounded-lg shadow-md">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="flex justify-center mb-6">
      <div class="rounded-full bg-green-100 p-4">
        <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
    </div>

    <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-2">
      Pesanan Dikonfirmasi!
    </h2>
    <p class="text-center text-sm text-gray-600 mb-8 max-w-md mx-auto">
      Terima kasih telah memesan layanan kebersihan. Pesanan Anda telah berhasil diproses.
    </p>
  </div>

  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white shadow-lg rounded-lg py-8 px-6 sm:px-10 border border-gray-200">
      <h3 class="text-xl font-semibold text-gray-900 mb-6 border-b border-gray-200 pb-3">
        Detail Pesanan
      </h3>
      <div class="space-y-4 text-gray-700 text-sm">
        <div class="flex justify-between">
          <span class="font-medium">Nomor Pesanan:</span>
          <span class="text-gray-900">#{{ $order->id }}</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Jenis Layanan:</span>
          <span class="text-gray-900">{{ ucwords(str_replace('_', ' ', $order->service_type)) }}</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Total Biaya:</span>
          <span class="text-green-700 font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Estimasi Durasi:</span>
          <span class="text-gray-900">{{ $order->estimated_duration }} jam</span>
        </div>
      </div>

      <div class="mt-8">
        <a href="{{ route('orders.user.index') }}" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">
          Lihat Semua Pesanan
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
