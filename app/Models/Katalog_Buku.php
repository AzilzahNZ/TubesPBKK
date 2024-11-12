<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Katalog_Buku extends Model
{
    protected $table = 'katalog__bukus';
    protected $fillable = [
        'cover',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'genre',
        'sinopsis',
        'stok',
        'status',
    ];

    // Relasi One-to-Many dengan Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
