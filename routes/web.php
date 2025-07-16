<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kegiatan', [HomeController::class, 'kegiatan'])->name('kegiatan');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/donasi', [HomeController::class, 'donasi'])->name('donasi');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/kegiatan/{id}', [HomeController::class, 'detailkegiatan'])->name('kegiatan.detail');
Route::middleware('auth')->group(function () {
    Route::get('/formlayanan', [HomeController::class, 'formlayanan'])->name('formlayanan');
    Route::get('/formdonasi', [HomeController::class, 'formdonasi'])->name('formdonasi');
});

Route::redirect('/login', '/santun/login')->name('login');


Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.callback');