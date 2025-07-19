<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/report', [ReportController::class, 'store']);
});
