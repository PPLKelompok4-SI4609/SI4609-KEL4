@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <div class="max-w-4xl mx-auto bg-white shadow p-6 rounded">
        {{-- Gambar Utama --}}
        <img src="{{ asset('storage/' . $article->main_image) }}" alt="{{ $article->title }}" class="w-full h-auto rounded mb-6">

        {{-- Judul --}}
        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

        {{-- Isi Artikel --}}
        <div class="prose max-w-none mb-8">
            {!! nl2br(e($article->content)) !!}
        </div>

        {{-- Gambar Tambahan (jika ada) --}}
        @if($article->extra_image)
            <img src="{{ asset('storage/' . $article->extra_image) }}" alt="Gambar Tambahan" class="w-full h-auto rounded mb-6">
        @endif

        {{-- Tombol Variasi --}}
        <div class="mt-6">
            <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Variations</a>
        </div>
    </div>

    {{-- Kolom Preview/Comment Section --}}
    <div class="max-w-4xl mx-auto mt-10 bg-gray-100 p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-2">Preview</h2>
        <p class="text-gray-700">There are many variations of passages of Lorem Ipsum available...</p>
    </div>
</div>
@endsection
