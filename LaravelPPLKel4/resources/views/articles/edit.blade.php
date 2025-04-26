@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Article</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" required>{{ $article->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" class="form-control" value="{{ $article->category }}" required>
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input type="url" name="image_url" class="form-control" value="{{ $article->image_url }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection