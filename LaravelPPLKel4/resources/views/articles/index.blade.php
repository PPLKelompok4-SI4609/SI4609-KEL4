@extends('layouts.app')

@section('content')
<body class="bg-white text-gray-900">

  <!-- Articles header -->
  <div class="bg-gray-500 text-white font-semibold text-center py-8 text-lg sm:text-xl">
    Articles
  </div>

  <!-- Add Article Button -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 text-right">
    <a href="{{ route('articles.create') }}" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
      Tambah Artikel
    </a>
  </div>

  <!-- Search Form -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 justify-center">
    <select name="category" class="border border-gray-400 rounded px-3 py-2 text-sm w-full sm:w-48" onchange="this.form.submit()">
        <option value="">All Categories</option>
        <option value="Musim Kemarau" {{ request('category') == 'Musim Kemarau' ? 'selected' : '' }}>Musim Kemarau</option>
        <option value="Musim Hujan" {{ request('category') == 'Musim Hujan' ? 'selected' : '' }}>Musim Hujan</option>
    </select>

    <form action="{{ route('articles.index') }}" method="GET" class="flex border border-gray-400 rounded w-full sm:w-64">
      <input name="search" value="{{ old('search', $searchQuery) }}" aria-label="Search" class="flex-grow px-3 py-2 text-sm focus:outline-none" placeholder="Search" type="text"/>
      <button type="submit" aria-label="Search button" class="px-3 flex items-center justify-center border-l border-gray-400 text-gray-700 hover:text-black">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </div>

  <!-- Articles grid -->
  <main class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($articles as $article)
    <article class="space-y-3">
      
      @if ($article->image_url)
        <img alt="{{ $article->title }}" class="w-full h-48 object-cover rounded-lg shadow-md" src="{{ asset('storage/' . $article->image_url) }}" />
      @else
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-lg shadow-md">
          <span class="text-gray-500">No Image</span>
        </div>
      @endif

      <div class="flex items-center space-x-2 text-xs text-gray-500">
        <i class="fas fa-file-alt"></i>
        <span>{{ $article->category }}</span>
      </div>
      <h3 class="text-blue-900 font-semibold text-sm leading-tight hover:underline cursor-pointer">
        {{ $article->title }}
      </h3>
      <p class="text-xs leading-snug text-gray-700">
        {{ Str::limit($article->content, 100) }}
      </p>
      
      <!-- Read More Button -->
      <div class="mt-4">
        <a href="{{ route('articles.show', $article->id) }}" class="bg-blue-900 text-white text-xs px-3 py-1 rounded hover:bg-blue-800 transition">
          Read More
        </a>
      </div>

      <!-- Edit and Delete Buttons -->
      <div class="flex space-x-2 mt-2">
          <a href="{{ route('articles.edit', $article->id) }}" class="bg-yellow-500 text-white text-xs px-3 py-1 rounded hover:bg-yellow-400 transition">Edit</a>
          
          <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-red-600 text-white text-xs px-3 py-1 rounded hover:bg-red-500 transition">Delete</button>
          </form>
      </div>
    </article>
    @endforeach
  </main>

  <!-- Pagination -->
  <nav aria-label="Pagination" class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 flex justify-center space-x-2 text-xs sm:text-sm">
    {{ $articles->links() }}
  </nav>

</body>
@endsection
