@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Artikel</h1>
    <form action="{{ route('admin.articles.update', $article) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.articles.form', ['article' => $article])
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
