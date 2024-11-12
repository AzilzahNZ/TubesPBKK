<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user_ole;
use App\Models\user_role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            
            [
                'title' => 'Dashboard',
                'link' => 'index',
                'icon' => 'icon-index',
                'role' => 'admin',
            ],
            
            [
                'title' => 'Katalog Buku',
                'link' => 'katalog-buku',
                'icon' => 'icon-katalog',
                'role' => 'admin',
            ],

            [
                'title' => 'Peminjaman',
                'link' => 'peminjaman',
                'icon' => 'icon-peminjaman',
                'role' => 'admin',
            ],
            
            [
                'title' => 'Pengunjung',
                'link' => 'pengunjung',
                'icon' => 'icon-pengunjung',
                'role' => 'admin',
            ],

            [
                'title' => 'Katalog Buku',
                'link' => 'index',
                'icon' => 'icon-katalog',
                'role' => 'pengunjung',
            ],

            [
                'title' => 'Riwayat Peminjaman',
                'link' => 'riwayat-peminjaman',
                'icon' => 'icon-riwayat-peminjaman',
                'role' => 'pengunjung',
            ],

        ];

        foreach ($roles as $role) {
            user_role::create($role);
        }
    }
}
