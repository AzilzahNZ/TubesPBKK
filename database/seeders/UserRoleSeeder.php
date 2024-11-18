<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user_ole;
use App\Models\user_role;
use App\Models\UserRole;

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
                'title' => 'Manajemen Akun Pengguna',
                'link' => 'akun-pengguna',
                'icon' => 'icon-akun-pengguna',
                'role' => 'admin',
            ],


            [
                'title' => 'Dashboard',
                'link' => 'index',
                'icon' => 'icon-index',
                'role' => 'ormawa',
            ],
            [
                'title' => 'Pengajuan Surat',
                'link' => 'pengajuan-surat',
                'icon' => 'icon-pengajuan-surat',
                'role' => 'ormawa',
            ],
            [
                'title' => 'Riwayat Pengajuan Surat',
                'link' => 'riwayat-pengajuan-surat',
                'icon' => 'icon-riwayat-pengajuan-surat',
                'role' => 'ormawa',
            ],


            [
                'title' => 'Dashboard',
                'link' => 'index',
                'icon' => 'icon-index',
                'role' => 'staff-kemahasiswaan',
            ],
            [
                'title' => 'Surat Masuk',
                'link' => 'surat-masuk',
                'icon' => 'icon-surat-masuk',
                'role' => 'staff-kemahasiswaan',
            ],
            [
                'title' => 'Surat Keluar',
                'link' => 'surat-keluar',
                'icon' => 'icon-surat-keluar',
                'role' => 'staff-kemahasiswaan',
            ],
            [
                'title' => 'Riwayat Surat',
                'link' => 'riwayat-surat',
                'icon' => 'icon-riwayat-surat',
                'role' => 'staff-kemahasiswaan',
            ],

            [
                'title' => 'Dashboard',
                'link' => 'index',
                'icon' => 'icon-index',
                'role' => 'staff-tu',
            ],
            [
                'title' => 'Riwayat Surat',
                'link' => 'riwayat-surat',
                'icon' => 'icon-riwayat-surat',
                'role' => 'staff-tu',
            ],



        ];

        foreach ($roles as $role) {
            UserRole::create($role);
        }
    }
}
