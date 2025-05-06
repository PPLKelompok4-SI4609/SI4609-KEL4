<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
<<<<<<< Updated upstream
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
=======
use App\Http\Controllers\CleaningController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FloodRescueController;
use App\Notifications\FloodRescueEduNotification;
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('articles', AdminArticleController::class);
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create'); // pindah ke atas
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
<<<<<<< Updated upstream
=======
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
    
// Route untuk mengirimkan notifikasi
Route::get('/send-notification', [FloodRescueController::class, 'sendNotification'])->name('send.notification');

Route::get('/send-notification', function () {
    // Ambil pengguna pertama dari database
    $user = User::first(); 

    // Kirimkan notifikasi ke pengguna pertama
    $user->notify(new FloodRescueEduNotification("Test notifikasi: Kesiapsiagaan banjir!"));

    // Tampilkan pesan konfirmasi
    return "Notifikasi telah dikirim!";
});

Route::get('/send-dummy-notification', [FloodRescueController::class, 'sendDummyNotification'])->name('send.dummy.notification');



>>>>>>> Stashed changes



