@extends('admin.layouts.app')

@section('title', 'FloodRescue | Kelola Artikel')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-blue-600">Kelola Artikel</h1>
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

@if ($articles->isEmpty())
    <div class="text-center py-10 text-gray-500">
        Belum ada artikel untuk dikelola.
    </div>
@else
    <div class="grid gap-6">
        @foreach ($articles as $article)
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                    <div class="flex items-start gap-6">
                        @if ($article->image_url)
                            <img 
                                src="{{ asset('storage/' . $article->image_url) }}" 
                                alt="{{ $article->title }}" 
                                class="w-40 h-32 object-cover rounded-md flex-shrink-0"
                            >
                        @endif

                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $article->title }}</h2>
                            <p class="text-sm text-gray-600 mt-1">Penulis: {{ $article->user->name ?? '-' }}</p>
                            <p class="text-sm text-gray-600">Dibuat: {{ $article->created_at->format('d M Y, H:i') }}</p>

                            <p class="mt-2 mb-4 text-sm font-semibold">
                                Status: 
                                <span class="px-2 py-1 rounded 
                                    @if($article->status == 'pending') bg-yellow-100 text-yellow-700 
                                    @elseif($article->status == 'approved') bg-green-100 text-green-700 
                                    @elseif($article->status == 'rejected') bg-red-100 text-red-700 
                                    @endif
                                ">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </p>

                            <p class="mt-3 text-gray-700 line-clamp-2">{{ $article->excerpt }}</p>

                            <a href="{{ route('admin.articles.show', $article->id) }}" 
                            class="mt-3 inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                        @if ($article->status == 'pending')
                           
                            <form method="POST" action="{{ route('admin.articles.updateStatus', $article->id) }}" class="flex flex-col items-end gap-2 w-full">
                                @csrf
                                @method('PUT')

                                <select 
                                    name="status" 
                                    id="status-select-{{ $article->id }}"
                                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    onchange="toggleReason(this, {{ $article->id }})"
                                >
                                    <option value="pending" {{ $article->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $article->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                    <option value="rejected" {{ $article->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                </select>

                                <textarea 
                                    name="reason"
                                    id="reason-field-{{ $article->id }}"
                                    placeholder="Tulis alasan penolakan..."
                                    class="mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm w-full focus:outline-none focus:ring-2 focus:ring-red-400"
                                    style="display: {{ $article->status === 'rejected' ? 'block' : 'none' }}"
                                >{{ old('reason', $article->reason) }}</textarea>

                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                    Update Status
                                </button>
                            </form>
                        @endif

                        @if (in_array($article->status, ['approved', 'rejected']))
                            <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                    Hapus Artikel
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<script>
    function toggleReason(select, id) {
        const field = document.getElementById('reason-field-' + id);
        if (select.value === 'rejected') {
            field.style.display = 'block';
        } else {
            field.style.display = 'none';
        }
    }

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
