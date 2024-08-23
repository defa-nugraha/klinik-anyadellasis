<?php

use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
            Route::get('/profil', [DashboardAdminController::class, 'index'])->name('admin.profil');
        });
    });

    Route::middleware('user')->group(function () {
        Route::prefix('client')->group(function () {});
    });
});

Auth::routes();
