@extends('layouts.app')

@section('title', 'FloodRescue | Artikel')

@section('content')
<body class="bg-white text-gray-900">

  <!-- Header -->
  <div class="bg-blue-800 text-white font-semibold text-center py-8 text-lg sm:text-xl rounded-lg shadow-md">
    Artikel
  </div>

  <!-- Action Buttons -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6 flex flex-col sm:flex-row sm:justify-between items-center gap-4">
    <a href="{{ route('articles.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 transition shadow">
      + Tambah Artikel
    </a>
    <a href="{{ route('articles.listarticle') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500 transition shadow">
      Tampilkan Artikel Saya
    </a>
  </div>

  <!-- Search & Filter -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 pb-6">
    <form method="GET" action="{{ route('articles.index') }}" class="flex flex-col sm:flex-row items-center gap-4">
      <select name="category" class="border border-gray-300 rounded px-3 py-2 text-sm w-full sm:w-48 focus:ring-2 focus:ring-blue-500">
        <option value="">Semua Kategori</option>
        <option value="Musim Kemarau" {{ request('category') == 'Musim Kemarau' ? 'selected' : '' }}>Musim Kemarau</option>
        <option value="Musim Hujan" {{ request('category') == 'Musim Hujan' ? 'selected' : '' }}>Musim Hujan</option>
      </select>

      <div class="flex border border-gray-300 rounded w-full sm:w-64 focus-within:ring-2 focus-within:ring-blue-500">
        <input name="search" value="{{ old('search', $searchQuery ?? '') }}" placeholder="Cari artikel..." aria-label="Search"
          class="flex-grow px-3 py-2 text-sm focus:outline-none rounded-l" type="text" />
        <button type="submit" aria-label="Search button" class="px-3 text-gray-600 hover:text-blue-700 transition">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </form>
  </div>

  <!-- Article Grid -->
  <main class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ($articles as $article)
    <article class="bg-white border border-gray-200 rounded-lg p-4 shadow hover:shadow-md transition space-y-3">
      @if ($article->image_url)
        <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}"
          class="w-full h-48 object-cover rounded-md">
      @else
        <div class="w-full h-48 bg-gray-100 flex items-center justify-center rounded-md">
          <span class="text-gray-400">Tidak Ada Gambar</span>
        </div>
      @endif

      <div class="flex items-center text-xs text-gray-500 space-x-2">
        <i class="fas fa-tag"></i>
        <span>{{ $article->category }}</span>
      </div>

      <h3 class="text-blue-900 font-semibold text-sm leading-tight hover:underline cursor-pointer">
        {{ $article->title }}
      </h3>

      <p class="text-xs text-gray-700">{{ Str::limit($article->content, 100) }}</p>

      <!-- Action Buttons -->
      <div class="flex flex-wrap justify-between items-center mt-4 gap-2">
        <a href="{{ route('articles.show', $article->id) }}"
           class="bg-blue-700 text-white text-xs px-3 py-1 rounded hover:bg-blue-600 transition">
          Baca
        </a>
      </div>
    </article>
    @empty
    <div class="col-span-full text-center text-gray-500 py-12">
      <i class="fas fa-file-alt text-4xl mb-4"></i>
      <p>Tidak ada artikel ditemukan.</p>
    </div>
    @endforelse
  </main>

  <!-- Pagination -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 flex justify-center">
    {{ $articles->links() }}
  </div>

</body>
@endsection
