<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrmawaController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffKemahasiswaanController;
use App\Http\Controllers\StaffTUController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin.manajemen-akun-pengguna', [AdminController::class, 'manajemen_akun_pengguna'])->name('admin.manajemen-akun-pengguna');
});

Route::middleware(['auth', 'role:ormawa'])->group(function () {
    Route::get('/ormawa', [OrmawaController::class, 'index'])->name('ormawa.index');
    Route::get('/ormawa.pengajuan-surat', [OrmawaController::class, 'pengajuan_surat'])->name('ormawa.pengajuan-surat');
    Route::get('/ormawa.riwayat-pengajuan-surat', [OrmawaController::class, 'riwayat_pengajuan_surat'])->name('ormawa.riwayat-pengajuan-surat');
});

Route::middleware(['auth', 'role:staff-kemahasiswaan'])->group(function () {
    Route::get('/staff-kemahasiswaan', [StaffKemahasiswaanController::class, 'index'])->name('staff-kemahasiswaan.index');
    Route::get('/staff-kemahasiswaan.surat-masuk', [StaffKemahasiswaanController::class, 'surat_masuk'])->name('staff-kemahasiswaan.surat-masuk');
    Route::get('/staff-kemahasiswaan.surat-keluar', [StaffKemahasiswaanController::class, 'surat_keluar'])->name('staff-kemahasiswaan.surat-keluar');
    Route::get('/staff-kemahasiswaan.riwayat-surat', [StaffKemahasiswaanController::class, 'riwayat_surat'])->name('staff-kemahasiswaan.riwayat-surat');
});

Route::middleware(['auth', 'role:staff-tu'])->group(function () {
    Route::get('/staff-tu', [StaffTUController::class, 'index'])->name('staff-tu.index');
    Route::get('/staff-tu.riwayat-surat', [StaffTUController::class, 'riwayat_surat'])->name('staff-tu.riwayat-surat');
});

require __DIR__.'/auth.php';
