<?php

use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\PasienAdminController;
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

            Route::prefix('pasien')->group(function () {
                Route::get('/', [PasienAdminController::class, 'index'])->name('admin.pasien');
                Route::get('/create', [PasienAdminController::class, 'create'])->name('admin.pasien.create');
                Route::post('/store', [PasienAdminController::class, 'store'])->name('admin.pasien.store');
                Route::post('/update', [PasienAdminController::class, 'update'])->name('admin.pasien.update');
                Route::delete('/delete', [PasienAdminController::class, 'delete'])->name('admin.pasien.delete');
            });
        });
    });

    Route::middleware('user')->group(function () {
        Route::prefix('client')->group(function () {});
    });
});

Auth::routes();
