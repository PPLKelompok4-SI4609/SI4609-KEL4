@extends('admin.layouts.app')

@section('title', 'FloodRescue | Dashboard Admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-blue-600">Dashboard Admin</h1>
</div>
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
<div class="bg-white shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4">Selamat datang, {{ auth()->user()->name }}!</h2>
    <p class="text-gray-700">Ini adalah dashboard admin FloodRescue. Anda dapat mengelola artikel, pengguna, dan lainnya di sini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-4 rounded-lg shadow-sm">
        <p class="text-gray-500 text-sm">Jumlah User</p>
        <h3 class="text-2xl font-semibold text-blue-600">{{ $userCount }}</h3>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm">
        <p class="text-gray-500 text-sm">Jumlah Laporan</p>
        <h3 class="text-2xl font-semibold text-red-500">{{ $reportCount }}</h3>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm">
        <p class="text-gray-500 text-sm">Jumlah Artikel</p>
        <h3 class="text-2xl font-semibold text-green-500">{{ $articleCount }}</h3>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm">
        <p class="text-gray-500 text-sm">Jumlah Pemesan Layanan Pasca Banjir</p>
        <h3 class="text-2xl font-semibold text-purple-500">0</h3>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <div class="bg-white p-4 rounded-lg shadow-sm">
        <p class="text-gray-500 text-xs mb-2">Statistik Status Laporan</p>
        <div class="relative w-full h-60">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-3">
        @php
            $statusColors = ['Dikirim' => 'text-blue-600', 'Diproses' => 'text-yellow-500', 'Ditolak' => 'text-red-500', 'Selesai' => 'text-green-500'];
        @endphp
        @foreach (['Dikirim', 'Diproses', 'Ditolak', 'Selesai'] as $status)
            <div class="bg-white p-3 rounded-lg shadow-sm">
                <p class="text-gray-500 text-xs">Status "{{ $status }}"</p>
                <h3 class="text-xl font-semibold {{ $statusColors[$status] }}">{{ $statusCounts[$status] ?? 0 }}</h3>
            </div>
        @endforeach
    </div>
</div>

<div class="bg-white p-4 rounded-lg shadow-sm mt-8">
    <h2 class="text-lg font-medium text-gray-700 mb-4">Cuaca & Risiko Banjir 5 Kota Besar</h2>
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        @foreach($cityWeatherData as $city => $data)
            @php
                $riskLabel = $data['floodRisk'];
                $riskClass = $riskLabel == 'High' ? 'text-red-400' : ($riskLabel == 'Medium' ? 'text-orange-300' : 'text-green-300');
                $weather = $data['currentWeather'];
                
                $condition = strtolower($weather['weather'][0]['main'] ?? '');
                $gradients = [
                    'clear' => 'linear-gradient(135deg, #81d4fa, #0288d1)',
                    'clouds' => 'linear-gradient(135deg, #b0bec5, #546e7a)',
                    'rain' => 'linear-gradient(135deg, #4fc3f7, #0288d1)',
                    'drizzle' => 'linear-gradient(135deg, #80deea, #26c6da)',
                    'thunderstorm' => 'linear-gradient(135deg, #4db6ac, #00796b)',
                    'snow' => 'linear-gradient(135deg, #e1f5fe, #b3e5fc)',
                    'mist' => 'linear-gradient(135deg, #cfd8dc, #90a4ae)',
                    'fog' => 'linear-gradient(135deg, #cfd8dc, #90a4ae)',
                ];
                $bgGradient = $gradients[$condition] ?? $gradients['clear'];
            @endphp
            <div class="relative rounded-lg shadow-sm overflow-hidden text-center text-white" style="background: {{ $bgGradient }};">
                <!-- Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                
                <div class="relative p-4">
                    <h3 class="font-semibold">{{ $city }}</h3>
                    <img class="mx-auto w-16 h-16 my-2" src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] ?? '01d' }}@2x.png" alt="{{ $weather['weather'][0]['description'] ?? '' }}">
                    <p class="text-2xl font-bold">{{ round($weather['main']['temp'] ?? 0) }}°C</p>
                    <p class="text-sm">{{ ucfirst($weather['weather'][0]['description'] ?? '') }}</p>
                    <p class="mt-2 text-xs">Wind: {{ $weather['wind']['speed'] ?? '-' }} m/s</p>
                    <p class="text-xs">Humidity: {{ $weather['main']['humidity'] ?? '-' }}%</p>
                    <p class="text-sm mt-2">Flood Risk: <span class="font-bold {{ $riskClass }}">{{ $riskLabel }}</span></p>
                    @if($riskLabel === "High")
                        <p class="text-red-300 text-sm mt-2"><i class="fas fa-bell mr-1"></i>Siaga</p>
                    @elseif($riskLabel === "Medium")
                        <p class="text-orange-300 text-sm mt-2"><i class="fas fa-exclamation-triangle mr-1"></i>Waspada</p>
                    @else
                        <p class="text-green-300 text-sm mt-2"><i class="fas fa-check-circle mr-1"></i>Aman</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const statusChart = new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Dikirim', 'Diproses', 'Ditolak', 'Selesai'],
            datasets: [{
                data: [
                    {{ $statusCounts['Dikirim'] ?? 0 }},
                    {{ $statusCounts['Diproses'] ?? 0 }},
                    {{ $statusCounts['Ditolak'] ?? 0 }},
                    {{ $statusCounts['Selesai'] ?? 0 }}
                ],
                backgroundColor: ['#3b82f6', '#facc15', '#f87171', '#34d399']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 10 } }
                }
            },
            cutout: '70%'
        }
    });
</script>
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
