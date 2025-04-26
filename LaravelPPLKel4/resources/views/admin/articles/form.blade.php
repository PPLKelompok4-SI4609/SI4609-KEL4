@php
    $article = $article ?? null;
@endphp

<div class="mb-3">
    <label for="title" class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $article->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="content" class="form-label">Konten</label>
    <textarea name="content" class="form-control" rows="5" required>{{ old('content', $article->content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="author" class="form-label">Penulis</label>
    <input type="text" name="author" class="form-control" value="{{ old('author', $article->author ?? '') }}">
</div>
