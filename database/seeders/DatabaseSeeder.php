<?php

namespace Database\Seeders;

use App\Models\Katalog_Buku;
use App\Models\Peminjaman;
use App\Models\Pengunjung;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Seeder untuk tabel pengunjungs
        $pengunjungs = [
            [
                'user_id' => 2,
                'no_hp' => '08123456789',
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Jl. Contoh, Kota Contoh',
            ],
            [
                'user_id' => 3,
                'no_hp' => '08234567890',
                'jenis_kelamin' => 'perempuan',
                'alamat' => 'Jl. Contoh, Kota Contoh',
            ],
        ];

        foreach ($pengunjungs as $data) {
            Pengunjung::create($data);
        }
        

        //Seeder untuk tabel katalog buku
        $katalog__bukus = [
            [
                'cover' => asset('assets/img/cover1.jpg'),
                'judul' => 'Kata',
                'penulis' => 'Rintik Sedu',
                'penerbit' => 'Kawah Media',
                'tahun_terbit' => '2018',
                'genre' => 'romance',
                'sinopsis' => 'Novel Kata oleh Rintik Sedu bercerita tentang hati Binta yang penuh bimbang. Binta terjebak dalam masa lalu yang belum usai, sementara cinta baru yang hangat sudah siap menyambut dirinya untuk melangkah maju.',
                'stok' => 10,
                'status' => 'tersedia',
            ],
            [
                'cover' => 'assets/images/cover2.jpg',
                'judul' => 'Cantik Itu Luka',
                'penulis' => 'Eka Kurniawan',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2018',
                'genre' => 'romance',
                'sinopsis' => 'Hidup di era kolonialisme bagi para wanita dianggap sudah setara seperti hidup di neraka. Terutama bagi para wanita berparas cantik yang menjadi incaran tentara penjajah untuk melampiaskan hasrat mereka. Itu lah takdir miris yang dilalui Dewi Ayu, demi menyelamatkan hidupnya sendiri Dewi harus menerima paksaan menjadi pelacur bagi tentara Belanda dan Jepang selama masa kedudukan mereka di Indonesia.',
                'stok' => 5,
                'status' => 'tersedia',
            ],
        ];

        foreach ($katalog__bukus as $data) {
            Katalog_Buku::create($data);
        }

        //Seeder untuk tabel peminjaman
        $peminjamans = [
            [
                'pengunjung_id' => 1,
                'buku_id' => 1,
                'tanggal_peminjaman' => now(),
                'tanggal_pengembalian' => now()->addDays(7),
                'status' => 'Dipinjam',
            ],
            [
                'pengunjung_id' => 2,
                'buku_id' => 2,
                'tanggal_peminjaman' => now(),
                'tanggal_pengembalian' => now()->addDays(7),
                'status' => 'Dipinjam',
            ],
        ];

        foreach ($peminjamans as $data) {
            Peminjaman::create($data);
        }

    }
}
