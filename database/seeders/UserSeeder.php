<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' =>  'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '08123456789',
                'role' => 'admin',
            ],
    
            //ormawa
            [
                'name' =>  'HIMATIF',
                'email' => 'himatif@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '08123456789',
                'role' => 'ormawa',
            ],

            //staff-kemahasiswaan
            [
                'name' =>  'Staff Kemahasiswaan',
                'email' => 'staff-kemahasiswaan@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '08123456789',
                'role' => 'staff-kemahasiswaan',
            ],

            //staff-tu
            [
                'name' =>  'Staff TU',
                'email' => 'staff-tu@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '08123456789',
                'role' => 'staff-tu',
            ],
        ]);
    }
}
