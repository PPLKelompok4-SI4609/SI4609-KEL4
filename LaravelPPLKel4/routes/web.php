<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanBanjirController;
use App\Http\Controllers\admin\AdminLaporanController;

Route::get('/laporan-banjir', [LaporanBanjirController::class, 'create'])->name('laporan-banjir.create');
Route::post('/laporan-banjir', [LaporanBanjirController::class, 'store'])->name('laporan-banjir.store');
Route::get('/status-laporan', [LaporanBanjirController::class, 'index'])->name('laporan-banjir.status');
// Admin Laporan Routes

Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
Route::put('/admin/laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('admin.laporan.updateStatus');
