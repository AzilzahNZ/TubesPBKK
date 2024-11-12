<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPeminjaman extends Model
{
    
    protected $fillable = [
        'pengunjung_id',
        'buku_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
    ];
}
