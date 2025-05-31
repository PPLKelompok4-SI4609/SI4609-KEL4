<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanBanjirController;
use App\Http\Controllers\admin\AdminLaporanController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminMapController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminCleaningController;
use App\Http\Controllers\admin\AdminArticleController;
use App\Http\Controllers\BantuanDaruratController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\FloodController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CleaningController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CleaningRequestController;
use App\Http\Controllers\OrderController;

// =======================
// Halaman Awal / Umum
// =======================
Route::get('/', function () {
    return view('welcome');
});

// =======================
// Halaman Welcome
// =======================
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// =======================
// Halaman Home
// =======================
Route::get('/home', function () {
    return view('home');
})->name('home');

// =======================
// Laporan Banjir (User)
// =======================
Route::prefix('laporan')->middleware(['auth', 'role:user', '2fa'])->group(function () {
    Route::get('/', [LaporanBanjirController::class, 'create'])->name('laporan.create');
    Route::post('/', [LaporanBanjirController::class, 'store'])->name('laporan.store');
    Route::get('/status', [LaporanBanjirController::class, 'index'])->name('laporan.status');
});

// =======================
// Laporan Banjir (Admin)
// =======================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::put('/laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('admin.laporan.updateStatus');
    Route::delete('/laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.destroy');
});

// =======================
// Kelola User (Admin)
// =======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/kelola-user', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/kelola-user/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});

// =======================
// Kelola Peta Banjir (Admin)
// =======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/peta-banjir', [AdminMapController::class, 'index'])->name('map.index');
    Route::post('/peta-banjir/update', [AdminMapController::class, 'updateFloodZones'])->name('map.updateFloodZones');
});

// =======================
// Kelola Artikel (Admin)
// =======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/artikel', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/artikel/{id}', [AdminArticleController::class, 'adminShow'])->name('articles.show');
    Route::put('artikel/{id}/status', [AdminArticleController::class, 'updateStatus'])->name('articles.updateStatus');
    Route::delete('/artikel/{id}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');
});

// ========================
// Kelola Layanan Pembersihan (Admin)
// =======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pembersihan', [AdminCleaningController::class, 'index'])->name('cleaning.index');
    Route::delete('/pembersihan/{order}', [AdminCleaningController::class, 'destroy'])->name('cleaning.destroy');
});

// =======================
// Artikel
// =======================
Route::prefix('articles')->middleware(['auth', 'role:user', '2fa'])->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/{id}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});
Route::get('/listarticle', [ArticleController::class, 'myArticles'])
    ->middleware(['auth', 'role:user', '2fa'])
    ->name('articles.listarticle');


// =======================
// Cuaca
// =======================
Route::get('/cuaca', [WeatherController::class, 'index'])->middleware(['auth', 'role:user', '2fa'])->name('cuaca.index');

// =======================
// Peta
// =======================
Route::get('/peta', [FloodController::class, 'showFloodMap'])->middleware(['auth', 'role:user', '2fa']);

// =======================
// Pasca Banjir
// =======================
Route::get('/pasca', [CleaningController::class, 'index'])->middleware(['auth', 'role:user', '2fa'])->name('pasca.index');

// =======================
// Donasi Banjir
// =======================
Route::get('/donasi', [DonationController::class, 'index'])->middleware(['auth', 'role:user', '2fa'])->name('donasi.index');
Route::post('/donasi', [DonationController::class, 'store'])->middleware(['auth', 'role:user', '2fa'])->name('donasi.store');

// =======================
// Autentikasi
// =======================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// =======================
// Two Factor Authentication
// =======================
Route::middleware(['auth'])->prefix('two-factor')->group(function () {
    Route::get('/', [TwoFactorController::class, 'show'])->name('two-factor.index');
    Route::post('/verify', [TwoFactorController::class, 'store'])->name('two-factor.verify');
    Route::post('/resend', [TwoFactorController::class, 'resend'])->name('two-factor.resend');
});

// =======================
// Reset Password
// =======================
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// =======================
// Bantuan Darurat
// =======================
Route::get('/bantuan-darurat', [BantuanDaruratController::class, 'index'])->middleware(['auth'])->name('halaman.bantuan');

// =======================
// Pesanan Pengguna
// =======================
Route::prefix('orders')->name('orders.')->middleware(['auth', 'role:user', '2fa'])->group(function () {
    Route::get('/', [OrderController::class, 'userIndex'])->name('user.index');
});

// =======================
// Permintaan Pembersihan
// =======================
Route::prefix('cleaning-request')->name('cleaning-request.')->middleware(['auth', 'role:user', '2fa'])->group(function () {
    Route::get('/', [CleaningRequestController::class, 'create'])->name('create');
    Route::post('/', [CleaningRequestController::class, 'store'])->name('store');
    Route::get('/{service_type}', [CleaningRequestController::class, 'createWithService'])
        ->name('create.with-service')
        ->where('service_type', 'home_cleaning|office_cleaning|furniture_cleaning');
    Route::get('/{order}/confirmation', [CleaningRequestController::class, 'confirmation'])->name('confirmation');
    Route::post('/calculate-price', [CleaningRequestController::class, 'calculatePrice'])->name('calculate-price');
});