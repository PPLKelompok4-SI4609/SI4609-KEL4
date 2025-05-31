@extends('admin.layouts.app')

@section('title', 'FloodRescue | Detail Artikel')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">{{ $article->title }}</h1>

    @if ($article->image_url)
        <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
    @endif

    <div class="mb-4 text-gray-700">
        <p><strong>Penulis:</strong> {{ $article->user->name ?? '-' }}</p>
        <p><strong>Dibuat:</strong> {{ $article->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Status:</strong> 
            <span class="px-2 py-1 rounded 
                @if($article->status == 'draft') bg-gray-100 text-gray-700
                @elseif($article->status == 'pending') bg-yellow-100 text-yellow-700
                @elseif($article->status == 'approved') bg-green-100 text-green-700
                @elseif($article->status == 'rejected') bg-red-100 text-red-700
                @endif
            ">
                {{ ucfirst($article->status) }}
            </span>
        </p>
        @if ($article->status == 'rejected' && $article->reason)
            <p class="mt-2 text-red-600"><strong>Alasan Penolakan:</strong> {{ $article->reason }}</p>
        @endif
    </div>

    <div class="prose max-w-none text-gray-800 mb-8">
        {!! $article->content !!}
    </div>

    <a href="{{ route('admin.articles.index') }}" 
       class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
       Kembali ke Daftar Artikel
    </a>
</div>
@endsection
