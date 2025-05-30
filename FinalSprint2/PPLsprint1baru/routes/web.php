<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CleaningRequestController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::prefix('cleaning-request')->name('cleaning-request.')->group(function () {
    Route::get('/', [CleaningRequestController::class, 'create'])->name('create');
    Route::post('/', [CleaningRequestController::class, 'store'])->name('store');
    Route::get('/{service_type}', [CleaningRequestController::class, 'createWithService'])
        ->name('create.with-service')
        ->where('service_type', 'home_cleaning|office_cleaning|furniture_cleaning');
    Route::get('/{order}/confirmation', [CleaningRequestController::class, 'confirmation'])->name('confirmation');
    Route::post('/calculate-price', [CleaningRequestController::class, 'calculatePrice'])->name('calculate-price');
});