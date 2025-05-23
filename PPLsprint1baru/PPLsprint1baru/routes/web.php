<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CleaningRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cleaning-request', [CleaningRequestController::class, 'create'])->name('cleaning-request.create');
Route::post('/cleaning-request', [CleaningRequestController::class, 'store'])->name('cleaning-request.store');
Route::get('/cleaning-request/{service_type}', [CleaningRequestController::class, 'createWithService'])
    ->name('cleaning-request.create.with-service')
    ->where('service_type', 'home_cleaning|office_cleaning|furniture_cleaning');
    Route::post('/calculate-price', [CleaningRequestController::class, 'calculatePrice'])->name('cleaning-request.calculate-price');