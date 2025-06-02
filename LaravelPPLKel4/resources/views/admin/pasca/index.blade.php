@extends('admin.layouts.app')

@section('title', 'FloodRescue | Kelola Pesanan Layanan Pasca Banjir')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Kelola Pesanan Layanan</h1>

    <div class="relative mb-6">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <input
            type="text"
            placeholder="Cari pesanan..."
            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        >
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3 text-left">No. Pesanan</th>
                    <th class="px-6 py-3 text-left">Pelanggan</th>
                    <th class="px-6 py-3 text-left">Alamat</th>
                    <th class="px-6 py-3 text-left">Jenis Layanan</th>
                    <th class="px-6 py-3 text-left">Metode Pembayaran</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">#{{ $order->id }}</td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">{{ $order->full_name }}</td>
                        <td class="px-6 py-4 text-gray-500 whitespace-nowrap">{{ $order->full_address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                {{ $order->service_type_display }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $methodMap = [
                                    'credit_card' => ['label' => 'Kartu Kredit', 'color' => 'bg-blue-100 text-blue-800'],
                                    'debit_card' => ['label' => 'Kartu Debit', 'color' => 'bg-green-100 text-green-800'],
                                    'bank_transfer' => ['label' => 'Transfer Bank', 'color' => 'bg-yellow-100 text-yellow-800'],
                                ];
                                $payment = $methodMap[$order->payment_method] ?? ['label' => 'Tidak Diketahui', 'color' => 'bg-gray-100 text-gray-800'];
                            @endphp

                            <span class="px-2 py-1 text-sm font-semibold rounded {{ $payment['color'] }}">
                                {{ $payment['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-800 font-semibold whitespace-nowrap">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <form action="{{ route('admin.cleaning.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">Tidak ada pesanan ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
