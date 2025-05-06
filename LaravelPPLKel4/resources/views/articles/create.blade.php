@extends('layouts.app')

@section('title', 'FloodRescue | Create Article')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">📝 Create New Article</h2>

        <!-- Start of the form -->
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title Field -->
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter article title" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Content Field -->
            <div>
                <label for="content" class="block text-lg font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="6" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Write your article content here..." required></textarea>
                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category Field -->
            <div>
                <label for="category" class="block text-lg font-medium text-gray-700">Category</label>
                <select name="category" id="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="Musim Kemarau">Musim Kemarau</option>
                    <option value="Musim Hujan">Musim Hujan</option>
                </select>
                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Upload Field -->
            <div>
                <label for="image" class="block text-lg font-medium text-gray-700">Upload Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full text-gray-700">
                <p class="mt-2 text-sm text-gray-500">Accepted formats: jpg, jpeg, png, gif (Max 2MB)</p>
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition duration-300 shadow-md">
                    Publish Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
