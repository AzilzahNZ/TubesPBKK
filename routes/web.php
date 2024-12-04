<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrmawaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffTUController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\RiwayatSuratController;
use App\Http\Controllers\StaffKemahasiswaanController;
use App\Http\Controllers\RiwayatPengajuanSuratController;
use Illuminate\Support\Facades\Http;

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
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin.manajemen-akun-pengguna', [AdminController::class, 'manajemen_akun_pengguna'])->name('admin.manajemen-akun-pengguna');
});
Route::put('/admin/edit-pengguna/{id}', [AdminController::class, 'updatePengguna'])->name('admin.edit-pengguna');
Route::delete('/admin/delete-pengguna/{id}', [AdminController::class, 'deletePengguna'])->name('admin.delete-pengguna');

// Menampilkan form untuk membuat pengguna baru
Route::get('/admin/create-pengguna', [AdminController::class, 'create'])->name('admin.create-pengguna');

// Menyimpan data pengguna baru
Route::post('/admin/store-pengguna', [AdminController::class, 'store'])->name('admin.store-pengguna');


Route::middleware(['auth', 'role:ormawa'])->group(function () {
    Route::get('/dashboard/ormawa', [OrmawaController::class, 'index'])->name('ormawa.index');
    Route::get('/ormawa.pengajuan-surat', [OrmawaController::class, 'pengajuan_surat'])->name('ormawa.pengajuan-surat');
    Route::get('/ormawa.riwayat-pengajuan-surat', [OrmawaController::class, 'riwayat_pengajuan_surat'])->name('ormawa.riwayat-pengajuan-surat');
    Route::get('/ormawa/detail-pengajuan-surat/{id}', [RiwayatPengajuanSuratController::class, 'detail'])->name('ormawa.detail-riwayat-pengajuan-surat');

    Route::get('/ormawa.pengajuan-surat.create', [OrmawaController::class, 'create'])->name('ormawa.pengajuan-surat.create');
    Route::get('/ormawa.riwayat-pengajuan-surat.index', [OrmawaController::class, 'index1'])->name('ormawa.riwayat-pengajuan-surat.index');
    Route::post('/ormawa/pengajuan-surat/store', [OrmawaController::class, 'store'])->name('ormawa/pengajuan-surat/store');
    Route::put('/ormawa/edit-pengajuan-surat/{id}', [OrmawaController::class, 'update'])->name('ormawa.edit-pengajuan-surat');
    Route::delete('/ormawa/destroy-pengajuan-surat/{id}', [OrmawaController::class, 'destroy'])->name('ormawa.destroy-pengajuan-surat');


    // Route::get('/ormawa.riwayat-pengajuan.index', [RiwayatPengajuanSuratController::class, 'index'])->name('ormawa.riwayat-pengajuan.index');
});

Route::middleware(['auth', 'role:staff-kemahasiswaan'])->group(function () {
    Route::get('/dashboard/staff-kemahasiswaan', [StaffKemahasiswaanController::class, 'index'])->name('staff-kemahasiswaan.index');

    Route::get('/staff-kemahasiswaan.surat-masuk', [SuratMasukController::class, 'index'])->name('staff-kemahasiswaan.surat-masuk');
    Route::get('/staff-kemahasiswaan/detail-surat-masuk/{id}', [SuratMasukController::class, 'detail'])->name('staff-kemahasiswaan.detail-surat-masuk');
    Route::post('/staff-kemahasiswaan/approve-surat/{id}', [SuratMasukController::class, 'approve'])->name('staff-kemahasiswaan.approve-surat');
    Route::post('/staff-kemahasiswaan/reject-surat/{id}', [SuratMasukController::class, 'reject'])->name('staff-kemahasiswaan.reject-surat');

    Route::get('/staff-kemahasiswaan.surat-keluar', [StaffKemahasiswaanController::class, 'surat_keluar'])->name('staff-kemahasiswaan.surat-keluar');
    Route::post('/staff-kemahasiswaan.surat-keluar.store', [StaffKemahasiswaanController::class, 'store'])->name('staff-kemahasiswaan.surat-keluar.store');
    // Route::post('/staff-kemahasiswaan.surat-keluar.store', [StaffKemahasiswaanController::class, 'store'])->name('staff-kemahasiswaan.surat-keluar.store');
});

Route::middleware(['auth', 'role:staff-tu'])->group(function () {
    Route::get('/dashboard/staff-tu', [StaffTUController::class, 'index'])->name('staff-tu.index');
});

Route::middleware(['auth', 'role:staff-kemahasiswaan|staff-tu'])->group(function () {
    Route::get('/riwayat-surat', [RiwayatSuratController::class, 'index'])->name('riwayat-surat');
    Route::get('/detail-riwayat-surat/{id}', [RiwayatSuratController::class, 'detail'])->name('detail-riwayat-surat');
});

require __DIR__ . '/auth.php';
