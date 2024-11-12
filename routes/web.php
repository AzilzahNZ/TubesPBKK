<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin.katalog-buku', [AdminController::class, 'katalogBuku'])->name('admin.katalog-buku');
    Route::get('/admin/{Katalog_Buku}', [AdminController::class, 'edit'])->name('edit');
    Route::delete('/admin/{Katalog_Buku}', [AdminController::class, 'destroy'])->name('destroy');
    Route::put('/admin/{Katalog_Buku}', [AdminController::class, 'update'])->name('update');
    Route::get('/admin.peminjaman', [AdminController::class, 'peminjaman'])->name('admin.peminjaman');
    Route::get('/admin.pengunjung', [AdminController::class, 'pengunjung'])->name('admin.pengunjung');
});

Route::middleware(['auth', 'role:pengunjung'])->group(function () {
    Route::get('/pengunjung', [PengunjungController::class, 'index'])->name('pengunjung.index');
    Route::get('/pengunjung.pinjam', [PengunjungController::class, 'pinjam'])->name('pengunjung.pinjam');
    Route::get('/pengunjung.riwayat-peminjaman', [PengunjungController::class, 'riwayatPeminjaman'])->name('pengunjung.riwayat-peminjaman');
});

require __DIR__.'/auth.php';
