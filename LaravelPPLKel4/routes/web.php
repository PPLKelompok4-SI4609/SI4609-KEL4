<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanBanjirController;
use App\Http\Controllers\admin\AdminLaporanController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ArticleController;


Route::get('/', function () {
    return view('landing');
});

Route::get('/laporan-banjir', [LaporanBanjirController::class, 'create'])->name('laporan-banjir.create');
Route::post('/laporan-banjir', [LaporanBanjirController::class, 'store'])->name('laporan-banjir.store');
Route::get('/status-laporan', [LaporanBanjirController::class, 'index'])->name('laporan-banjir.status');

Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
Route::put('/admin/laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('admin.laporan.updateStatus');

Route::get('/cuaca', [WeatherController::class, 'index'])->name('cuaca.index');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit'); // Edit route
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update'); // Update route
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy'); // Delete route




