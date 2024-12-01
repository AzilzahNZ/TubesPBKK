<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Atur locale Carbon ke bahasa Indonesia
        Carbon::setLocale('id');

        // Atur waktu PHP ke Indonesia
        setlocale(LC_TIME, 'id_ID.UTF-8');

        $menu = [
            (object) ['role' => 'admin', 'link' => 'index',  'title' => 'Dashboard'],
            (object) ['role' => 'admin', 'link' => 'manajemen-akun-pengguna',  'title' => 'Manajemen Akun Pengguna'],

            (object) ['role' => 'ormawa', 'link' => 'index',  'title' => 'Dashboard'],
            (object) ['role' => 'ormawa', 'link' => 'pengajuan-surat',  'title' => 'Pengajuan Surat'],
            (object) ['role' => 'ormawa', 'link' => 'riwayat-pengajuan-surat',  'title' => 'Riwayat Pengajuan Surat'],

            (object) ['role' => 'staff-kemahasiswaan', 'link' => 'index',  'title' => 'Dashboard'],
            (object) ['role' => 'staff-kemahasiswaan', 'link' => 'surat-masuk',  'title' => 'Surat Masuk'],
            (object) ['role' => 'staff-kemahasiswaan', 'link' => 'surat-keluar',  'title' => 'Surat Keluar'],
            (object) ['role' => 'staff-kemahasiswaan', 'link' => 'riwayat-surat',  'title' => 'Riwayat Surat'],

            (object) ['role' => 'staff-tu', 'link' => 'index',  'title' => 'Dashboard'],
            (object) ['role' => 'staff-tu', 'link' => 'riwayat-surat',  'title' => 'Riwayat Surat'],
        ];
        View::share('menu', $menu);
    }
}
