<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonasiPdfController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kegiatan', [HomeController::class, 'kegiatan'])->name('kegiatan');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/donasi', [HomeController::class, 'donasi'])->name('donasi');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/kegiatan/{id}', [HomeController::class, 'detailkegiatan'])->name('kegiatan.detail');

Route::middleware('auth')->group(function () {
    Route::get('/formlayanan/{slug?}', [HomeController::class, 'formlayanan'])->name('formlayanan');
    Route::post('/formlayanan', [HomeController::class, 'submitLayanan'])->name('formlayanan.submit');
    Route::get('/formdonasi/{slug?}', [HomeController::class, 'formdonasi'])->whereIn('slug', ['materi', 'non-materi'])->name('formdonasi');
    Route::post('/formdonasi', [HomeController::class, 'submitDonasi'])->name('formdonasi.submit');
});

Route::middleware(['web','auth']) // sesuaikan middleware admin/filament Anda
    ->get('/admin/donasi/rekap-pdf', [DonasiPdfController::class, 'rekap'])
    ->name('donasi.rekap.pdf');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [HomeController::class, 'showprofile'])->name('profile.show');
    Route::post('/profile', [HomeController::class, 'updateprofile'])->name('profile.update');
});

Route::get('/info-layanan/{slug?}', [HomeController::class, 'infoLayanan'])->name('info.layanan');
Route::get('/info-donasi/{slug?}', [HomeController::class, 'infoDonasi'])->name('info.donasi');


Route::redirect('/login', '/santun/login')->name('login');


Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.callback');