@extends('layouts.app')

@section('content')
<div class="bg-white text-gray-900">

  {{-- Navbar --}}
  <nav class="bg-blue-900 text-white px-6 py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <a href="{{ url('/') }}" class="text-xl font-semibold">InfoBanjir</a>
      <div class="space-x-4">
        <a href="{{ route('articles.index') }}" class="hover:underline">Articles</a>
        <a href="{{ url('/about') }}" class="hover:underline">About</a>
        <a href="{{ url('/contact') }}" class="hover:underline">Contact</a>
      </div>
    </div>
  </nav>

  <div class="container mx-auto px-4 sm:px-8 py-8">

    {{-- Gambar artikel --}}
    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full rounded-lg shadow-md">

    {{-- Konten artikel --}}
    <div class="mt-6">
      <h1 class="text-3xl font-bold mb-2">{{ $article->title }}</h1>
      <p class="text-sm text-gray-500 mb-4">
        <span class="font-semibold">Category:</span> {{ $article->category }}
      </p>
      <div class="text-base leading-relaxed">
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
