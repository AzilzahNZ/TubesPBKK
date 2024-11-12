<?php

namespace App\Providers;

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
        $menu = [
            (object) ['role' => 'admin', 'link' => 'index', 'title' => 'Dashboard'],
            (object) ['role' => 'admin', 'link' => 'katalog-buku', 'title' => 'Katalog Buku'],
            (object) ['role' => 'admin', 'link' => 'peminjaman', 'title' => 'Peminjaman'],
            (object) ['role' => 'admin', 'link' => 'pengunjung', 'title' => 'Pengunjung'],
            (object) ['role' => 'pengunjung', 'link' => 'index', 'title' => 'Katalog Buku'],
            (object) ['role' => 'pengunjung', 'link' => 'riwayat-peminjaman', 'title' => 'Riwayat Peminjaman'],
            // (object) ['role' => 'user', 'link' => 'profile', 'title' => 'Profile'],
        ];
    
        View::share('menu', $menu);
    }
}
