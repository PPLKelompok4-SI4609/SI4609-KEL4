@extends('admin.layouts.app')

@section('title', 'FloodRescue | Dashboard Admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-blue-600">Dashboard Admin</h1>
</div>

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Selamat datang, {{ auth()->user()->name }}!</h2>
    <p class="text-gray-700">Ini adalah dashboard admin FloodRescue. Anda dapat mengelola artikel, pengguna, dan lainnya di sini.</p>
</div>
@endsection