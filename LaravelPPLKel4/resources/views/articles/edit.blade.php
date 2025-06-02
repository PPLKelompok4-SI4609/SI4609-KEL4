@extends('layouts.app')

@section('title', 'FloodRescue | Edit Artikel')

@section('content')
<div class="container my-8">
    <h1 class="text-center mb-6 text-3xl font-bold text-black">📝 Edit Artikel</h1>
    <div class="bg-white shadow-lg rounded-lg p-6 md:w-1/2 mx-auto">
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="form-group mb-6">
                <label for="title" class="font-semibold text-lg text-gray-700">Judul</label>
                <input type="text" name="title" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300" value="{{ $article->title }}" required>
            </div>

            <!-- Content -->
            <div class="form-group mb-6">
                <label for="content" class="font-semibold text-lg text-gray-700">Konten</label>
                <textarea name="content" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300" rows="6" required>{{ $article->content }}</textarea>
            </div>

            <!-- Category -->
            <div class="form-group mb-6">
                <label for="category" class="font-semibold text-lg text-gray-700">Kategori</label>
                <select name="category" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300" required>
                    <option value="Musim Kemarau" {{ $article->category == 'Musim Kemarau' ? 'selected' : '' }}>Musim Kemarau</option>
                    <option value="Musim Hujan" {{ $article->category == 'Musim Hujan' ? 'selected' : '' }}>Musim Hujan</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div class="form-group mb-6">
                <label for="image" class="font-semibold text-lg text-gray-700">Gambar</label>
                <input type="file" name="image" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                @if ($article->image_url)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $article->image_url) }}" alt="Article Image" class="w-48 h-48 object-cover rounded-lg shadow-lg border-2 border-gray-300">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                    Update Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
