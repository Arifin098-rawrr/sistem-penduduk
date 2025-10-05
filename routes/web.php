<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KkController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

// ======================
// AUTH
// ======================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword'])->name('forgot.password.process');
// gunakan POST agar lebih aman (bukan GET)

// ======================
// PROTECTED ROUTES (hanya bisa diakses setelah login)
// ======================
Route::middleware(['auth.custom'])->group(function () {

    // Default redirect -> dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // Dashboard pakai controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ======================
    // CRUD Utama
    // ======================
    Route::resource('penduduk', PendudukController::class);
    Route::resource('kk', KkController::class);
    Route::resource('mutasi', MutasiController::class);

    // ======================
    // SURAT
    // ======================
    Route::middleware(['auth.custom'])->group(function () {
        Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
        Route::get('/surat/create/pengantar', [SuratController::class, 'createPengantar'])->name('surat.create.pengantar');
        Route::post('/surat/store/pengantar', [SuratController::class, 'storePengantar'])->name('surat.store.pengantar');
        Route::get('/surat/create/domisili', [SuratController::class, 'createDomisili'])->name('surat.create.domisili');
        Route::post('/surat/store/domisili', [SuratController::class, 'storeDomisili'])->name('surat.store.domisili');
        Route::get('/surat/cetak/pengantar/{id}', [SuratController::class, 'cetakPengantar'])->name('surat.cetak.pengantar');
        Route::get('/surat/cetak/domisili/{id}', [SuratController::class, 'cetakDomisili'])->name('surat.cetak.domisili');
        Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
    });
    
    // ======================
    // LAPORAN
    // ======================
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/penduduk', [LaporanController::class, 'penduduk'])->name('laporan.penduduk');
    Route::get('/laporan/surat', [LaporanController::class, 'surat'])->name('laporan.surat');
    Route::get('/laporan/mutasi', [LaporanController::class, 'mutasi'])->name('laporan.mutasi');

});
