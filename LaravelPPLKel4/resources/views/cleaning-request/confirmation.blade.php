<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <svg class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Pesanan Dikonfirmasi!
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Layanan kebersihan Anda berhasil dipesan.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Detail Pesanan</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Nomor Pesanan: <span class="font-medium text-gray-900">#{{ $order->id }}</span></p>
                            <p class="text-sm text-gray-500">Jenis Layanan: <span class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $order->service_type)) }}</span></p>
                            <p class="text-sm text-gray-500">Total Biaya: <span class="font-medium text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</span></p>
                            <p class="text-sm text-gray-500">Estimasi Durasi: <span class="font-medium text-gray-900">{{ $order->estimated_duration }} jam</span></p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('orders.user.index') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Lihat Semua Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 