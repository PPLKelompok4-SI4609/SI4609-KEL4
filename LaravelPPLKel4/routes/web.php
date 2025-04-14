<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanBanjirController;

Route::get('/laporan-banjir', [LaporanBanjirController::class, 'create'])->name('laporan-banjir.create');
Route::post('/laporan-banjir', [LaporanBanjirController::class, 'store'])->name('laporan-banjir.store');