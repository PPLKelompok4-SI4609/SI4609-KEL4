@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Artikel</h1>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary mb-3">+ Tambah Artikel</a>

    @foreach ($articles as $article)
        <div class="card mb-2">
            <div class="card-body">
                <h5>{{ $article->title }}</h5>
                <p><small>Author: {{ $article->author }}</small></p>
                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach

    {{ $articles->links() }}
</div>
@endsection
