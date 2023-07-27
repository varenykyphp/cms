<?php

use Illuminate\Support\Facades\Route;
use Varenyky\Http\Controllers\DashboardController;
use Varenyky\Http\Controllers\AuthenticationController;

Route::prefix(config('varenyky.path'))->name('admin.')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::get('/admin/login', [AuthenticationController::class, 'login'])->name('login');