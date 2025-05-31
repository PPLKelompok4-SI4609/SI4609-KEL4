<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanBanjirController;
use App\Http\Controllers\admin\AdminLaporanController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CleaningController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::get('/pasca-banjir', [CleaningController::class, 'index'])->name('pasca-banjir.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Two Factor Authentication Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'show'])->name('two-factor.show');
    Route::post('/two-factor', [TwoFactorController::class, 'store'])->name('two-factor.verify');
    Route::post('/two-factor/resend', [TwoFactorController::class, 'resend'])->name('two-factor.resend');
});

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/bantuan-darurat', function () {
    return view('HalamanBantuanDarurat.BantuanDarurat');
});



