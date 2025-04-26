@extends('layouts.app')

@section('content')
<body class="bg-white text-gray-900">
  <!-- Top blue bar -->
  <div class="bg-blue-800 text-white text-xs sm:text-sm flex flex-wrap sm:flex-nowrap items-center justify-between px-4 sm:px-8 py-1">
    <div class="flex items-center space-x-2 sm:space-x-4 text-center sm:text-left w-full sm:w-auto mb-1 sm:mb-0">
      <span>Lorem Ipsum is simply dummy text</span>
      <span class="hidden sm:inline">|</span>
      <span class="hidden sm:inline">Lorem Ipsum</span>
      <span class="hidden sm:inline">|</span>
      <span class="hidden sm:inline">Simple dummy text</span>
    </div>
    <div class="flex items-center space-x-4 text-xs sm:text-sm font-semibold uppercase tracking-wide">
      <button class="flex items-center space-x-1 hover:underline">
        <span>READABLE</span>
        <i class="fas fa-chevron-down text-xs"></i>
      </button>
      <a aria-label="Pinterest" class="hover:text-gray-300" href="#"><i class="fab fa-pinterest-p"></i></a>
      <a aria-label="Instagram" class="hover:text-gray-300" href="#"><i class="fab fa-instagram"></i></a>
      <a aria-label="Twitter" class="hover:text-gray-300" href="#"><i class="fab fa-twitter"></i></a>
      <a aria-label="Facebook" class="hover:text-gray-300" href="#"><i class="fab fa-facebook-f"></i></a>
      <button aria-label="Close top bar" class="hover:text-gray-300"><i class="fas fa-times"></i></button>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="flex items-center justify-between px-4 sm:px-8 py-3 border-b border-gray-200">
    <a class="font-pacifico text-2xl text-black select-none" href="#">Smile</a>
    <ul class="hidden md:flex space-x-6 text-sm text-gray-700 font-normal">
      <li><a class="hover:underline" href="#">Home</a></li>
      <li><a class="hover:underline" href="#">Issues</a></li>
      <li><a class="hover:underline" href="#">Digest</a></li>
      <li><a class="hover:underline" href="#">2022 Special Issue And Symposium</a></li>
      <li><a class="hover:underline" href="#">Announcements</a></li>
      <li><a class="hover:underline" href="#">About</a></li>
      <li><a class="hover:underline" href="#">Masthead</a></li>
      <li>
        <button aria-label="Search" class="text-gray-700 hover:text-black">
          <i class="fas fa-search"></i>
        </button>
      </li>
    </ul>
    <button aria-label="Open menu" class="md:hidden text-gray-700 hover:text-black focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
      <i class="fas fa-bars text-xl"></i>
    </button>
  </nav>

  <!-- Mobile menu -->
  <div class="hidden md:hidden px-4 pb-4 space-y-3 border-b border-gray-200" id="mobile-menu">
    <a class="block text-gray-700 hover:underline" href="#">Home</a>
    <a class="block text-gray-700 hover:underline" href="#">Issues</a>
    <a class="block text-gray-700 hover:underline" href="#">Digest</a>
    <a class="block text-gray-700 hover:underline" href="#">2022 Special Issue And Symposium</a>
    <a class="block text-gray-700 hover:underline" href="#">Announcements</a>
    <a class="block text-gray-700 hover:underline" href="#">About</a>
    <a class="block text-gray-700 hover:underline" href="#">Masthead</a>
    <button aria-label="Search" class="text-gray-700 hover:text-black">
      <i class="fas fa-search"></i>
    </button>
  </div>

  <!-- Articles header -->
  <div class="bg-gray-500 text-white font-semibold text-center py-8 text-lg sm :text-xl">
    Articles
  </div>

  <!-- Add Article Button -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 text-right">
    <a href="{{ route('articles.create') }}" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
      Tambah Artikel
    </a>
  </div>

  <!-- Filters -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 justify-center">
    <select aria-label="Category" class="border border-gray-400 rounded px-3 py-2 text-sm w-full sm:w-48">
      <option>Category</option>
    </select>
    <div class="flex border border-gray-400 rounded w-full sm:w-64">
      <input aria-label="Search" class="flex-grow px-3 py-2 text-sm focus:outline-none" placeholder="Search" type="text"/>
      <button aria-label="Search button" class="px-3 flex items-center justify-center border-l border-gray-400 text-gray-700 hover:text-black">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>

  <!-- Articles grid -->
  <main class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($articles as $article)
    <article class="space-y-3">
      <img alt="{{ $article->title }}" class="w-full h-48 object-cover" src="{{ $article->image_url }}" />
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
      <a href="{{ route('articles.show', $article->id) }}" class="bg-blue-900 text-white text-xs px-3 py-1 rounded hover:bg-blue-800 transition">
        Read More
      </a>
    </article>
    @endforeach
  </main>

  <!-- Pagination -->
  <nav aria-label="Pagination" class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 flex justify-center space-x-2 text-xs sm:text-sm">
    {{ $articles->links() }}
  </nav>

  <!-- Footer -->
  <footer class="bg-gray-100 text-gray-700 text-xs sm:text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 grid grid-cols-1 sm:grid-cols-3 gap-6 border-b border-gray-300">
      <div class="text-center sm:text-left">
        Lorem
        <br/>
        info@loremipsum.com
      </div>
      <div class="text-center sm:text-left space-y-2">
        <div class="font-semibold">Lorem Ipsum</div>
        <div class="flex justify-center sm:justify-start space-x-4 text-gray-600">
          <a aria-label="Facebook" class="hover:text-gray-900" href="#"><i class="fab fa-facebook-f"></i></a>
          <a aria-label="Twitter" class="hover:text-gray-900" href="#"><i class="fab fa-twitter"></i></a>
          <a aria-label="Instagram" class="hover:text-gray-900" href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="text-center sm:text-left space-y-2">
        <div class="font-semibold">And Typesetting</div>
        <button aria-label="With us" class="bg-blue-900 text-white text-xs sm:text-sm px-4 py-1 rounded hover:bg-blue-800 transition">With us</button>
      </div>
    </div>
    <div class="text-center py-2 text-gray-500">
      Lorem Ipsum Has Been The Industry's Standard Dummy Text Ever Since The 1500s, We
    </div>
  </footer>
</body>
@endsection