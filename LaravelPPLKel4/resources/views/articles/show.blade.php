@extends('layouts.app')

@section('title', 'FloodRescue | Article Details')

@section('content')
<div class="bg-white text-gray-900">

  <div class="container mx-auto px-4 sm:px-8 py-8">

    {{-- Judul Artikel --}}
    <div>
      <h1 class="text-4xl font-semibold mb-6">{{ $article->title }}</h1>
      <p class="text-base text-gray-500 mb-4">
        <span class="font-semibold">Category:</span> {{ $article->category }}
      </p>
    </div>

    {{-- Gambar artikel --}}
    <div class="mb-6">
      @if ($article->image_url)
        <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" class="w-3/4 rounded-lg shadow-md mx-auto">
      @else
        <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg shadow-md">
          <span class="text-gray-500">No Image Available</span>
        </div>
      @endif
    </div>

    {{-- Konten artikel --}}
    <div>
      <div class="text-lg leading-relaxed">
        {!! nl2br(e($article->content)) !!}
      </div>
    </div>

    {{-- Tombol kembali --}}
    <a href="{{ route('articles.index') }}" class="mt-8 inline-block bg-blue-900 text-white text-sm px-4 py-2 rounded hover:bg-blue-800 transition">
      ← Back to Articles
    </a>
  </div>
</div>
@endsection
