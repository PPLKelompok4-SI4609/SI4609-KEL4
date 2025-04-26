@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Artikel</h1>
    <form action="{{ route('admin.articles.store') }}" method="POST">
        @csrf
        @include('admin.articles.form')
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
