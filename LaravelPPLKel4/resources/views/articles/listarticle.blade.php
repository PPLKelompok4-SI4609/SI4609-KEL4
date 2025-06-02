@extends('layouts.app')

@section('title', 'FloodRescue | Artikel Saya')

@section('content')
<body class="bg-white text-gray-900">

  <!-- Header -->
  <div class="bg-blue-800 text-white font-semibold text-center py-8 text-xl rounded-lg shadow-md">
    Artikel Saya
  </div>

  <!-- Back Button -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-6">
    <a href="/articles" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 transition shadow">
      <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
  </div>

  <!-- Search & Filter -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      
      <form method="GET" action="{{ route('articles.listarticle') }}" class="flex flex-wrap gap-4 w-full">
        <select name="category" class="border border-gray-300 rounded px-3 py-2 text-sm w-full sm:w-auto focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Kategori</option>
            <option value="Musim Kemarau" {{ request('category') == 'Musim Kemarau' ? 'selected' : '' }}>Musim Kemarau</option>
            <option value="Musim Hujan" {{ request('category') == 'Musim Hujan' ? 'selected' : '' }}>Musim Hujan</option>
        </select>

        <div class="flex border border-gray-300 rounded w-full sm:w-64 focus-within:ring-2 focus-within:ring-blue-500">
          <input type="text" name="search" value="{{ old('search', $searchQuery ?? '') }}" placeholder="Cari artikel..."
            class="flex-grow px-3 py-2 text-sm focus:outline-none rounded-l">
          <button type="submit" class="px-3 text-gray-600 hover:text-blue-800 transition" aria-label="Cari">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>

    </div>
  </div>

  <!-- Article Grid -->
  <main class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ($articles as $article)
      <article class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition space-y-3">
        
        @if ($article->image_url)
          <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}"
            class="w-full h-48 object-cover rounded-md">
        @else
          <div class="w-full h-48 bg-gray-100 flex items-center justify-center rounded-md">
            <span class="text-gray-400">Tidak Ada Gambar</span>
          </div>
        @endif

        <!-- Category & Status -->
        <div class="flex items-center justify-between text-xs">
          <span class="text-gray-600"><i class="fas fa-tag mr-1"></i>{{ $article->category }}</span>
          
          @php
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800',
            ];
          @endphp
          <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$article->status] ?? 'bg-gray-100 text-gray-600' }}">
            {{ ucfirst($article->status) }}
          </span>
        </div>

        <!-- Title & Content -->
        <h3 class="text-blue-800 font-semibold hover:underline cursor-pointer">
          {{ $article->title }}
        </h3>
        <p class="text-sm text-gray-700 line-clamp-3">{{ Str::limit($article->content, 100) }}</p>

        {{-- Show reason if rejected --}}
        @if ($article->status === 'rejected' && $article->reason)
          <p class="text-xs text-red-600 italic mt-2">Alasan penolakan: {{ $article->reason }}</p>
        @endif

        <!-- Buttons -->
        <div class="flex justify-between items-center mt-4">
          <a href="{{ route('articles.show', $article->id) }}" class="text-sm bg-blue-700 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Baca</a>
          
          <div class="flex gap-2">
            <a href="{{ route('articles.edit', $article->id) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded hover:bg-yellow-300 transition">Edit</a>
            
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white text-xs px-3 py-1 rounded hover:bg-red-500 transition">Hapus</button>
            </form>
          </div>
        </div>
      </article>
      @empty
    <div class="col-span-full text-center text-gray-500 py-12">
        <i class="fas fa-file-alt text-4xl mb-4"></i>
        <p>Belum ada artikel yang ditulis.</p>
    </div>
    @endforelse
  </main>

  <!-- Pagination -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 pb-12">
    {{ $articles->links() }}
  </div>

</body>
@endsection
