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
                'role' => 'admin',
            ],
    
            //pengunjung
            [
                'name' =>  'Pengunjung1',
                'email' => 'pengunjung1@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pengunjung',
            ],
            [
                'name' =>  'Pengunjung2',
                'email' => 'pengunjung2@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pengunjung',
            ],
        ]);
    }
}
