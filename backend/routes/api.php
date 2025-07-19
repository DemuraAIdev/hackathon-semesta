<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/report', [ReportController::class, 'store']);

    Route::get('/report/user', [ReportController::class, 'myindex']);
    Route::get('/report/{report}', [ReportController::class, 'show']);
    Route::post('/report/close/{report}', [ReportController::class, 'close']);

    Route::get('/report', [ReportController::class, 'index'])->middleware(['role:supervisor']);

    Route::get('/assignment', [AssignmentController::class, 'index'])->middleware(['role:supervisor']);
    Route::get('/assignment/user', [AssignmentController::class, 'myindex'])->middleware(['role:plumber|electricity|security|cleaner']);

    Route::get('/location/user', [LocationController::class, 'myindex']);
});
