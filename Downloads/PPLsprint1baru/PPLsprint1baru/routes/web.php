<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CleaningRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cleaning-request', [CleaningRequestController::class, 'create'])->name('cleaning-request.create');
Route::post('/cleaning-request', [CleaningRequestController::class, 'store'])->name('cleaning-request.store');
