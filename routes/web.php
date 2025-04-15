<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Detail artikel
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('article.show');
