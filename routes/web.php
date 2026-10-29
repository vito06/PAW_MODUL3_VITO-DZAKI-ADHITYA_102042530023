<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

// Guest Routes (Khusus yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes (Khusus Admin yang sudah login)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // TODO: - Daftarkan route resource untuk BukuController ('buku')
    Route::resource('buku', BukuController::class);
    //      - Daftarkan route resource untuk AnggotaController ('anggota')
    Route::resource('anggota', AnggotaController::class)->parameters(['anggota' => 'anggota']);
    //      - Daftarkan route resource untuk PeminjamanController ('peminjaman')
    Route::resource('peminjaman', PeminjamanController::class);
    //      - Daftarkan route PUT '/peminjaman/{peminjaman}/kembali' yang mengarah ke PeminjamanController method 'kembali'
    Route::put('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])->name('peminjaman.kembali');   
});
