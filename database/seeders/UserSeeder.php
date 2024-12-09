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
                'no_telepon' => '628123456789',
                'role' => 'admin',
            ],
    
            //ormawa
            [
                'name' =>  'BEM Fakultas Teknik',
                'email' => 'bemft@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'DPM Fakultas Teknik',
                'email' => 'dpmft@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'HIMATIF',
                'email' => 'himatif@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '6285268178610',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'HMTS',
                'email' => 'hmts@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '6285764421910',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'HMM',
                'email' => 'hmm@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '6285268006350',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'HIMATRO',
                'email' => 'himatro@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '6285267988185',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'HMAR',
                'email' => 'hmar@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'HIMASIF',
                'email' => 'himasif@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'MOSTANEER',
                'email' => 'mostaneer@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'PULKANIK',
                'email' => 'pulkanik@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'ormawa',
            ],
            [
                'name' =>  'ERCOM',
                'email' => 'ercom@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'ormawa',
            ],


            //staff-kemahasiswaan
            [
                'name' =>  'Staff Kemahasiswaan',
                'email' => 'staff-kemahasiswaan@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628989066334',
                'role' => 'staff-kemahasiswaan',
            ],

            //staff-tu
            [
                'name' =>  'Staff TU',
                'email' => 'staff-tu@gmail.com',
                'password' => Hash::make('password'),
                'no_telepon' => '628123456789',
                'role' => 'staff-tu',
            ],
        ]);
    }
}
