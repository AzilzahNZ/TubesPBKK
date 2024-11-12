<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'pengunjung_id',
        'buku_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
    ];

    // Relasi Many-to-One dengan Pengguna
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class);
    }

    // Relasi Many-to-One dengan Katalog_Buku
    public function katalogBuku()
    {
        return $this->belongsTo(Katalog_Buku::class);
    }

    // Accessor untuk status otomatis
    public function getStatusAttribute()
    {
        $today = Carbon::today();

        if ($today->lessThanOrEqualTo($this->tanggal_pengembalian) && $today->greaterThanOrEqualTo($this->tanggal_peminjaman)) {
            return 'Dipinjam';
        } elseif ($today->greaterThan($this->tanggal_pengembalian)) {
            return 'Denda';
        } else {
            return 'Dikembalikan';
        }
    }

    // Event model untuk menetapkan default tanggal pengembalian
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($peminjaman) {
            if (is_null($peminjaman->tanggal_pengembalian) && !is_null($peminjaman->tanggal_peminjaman)) {
                $peminjaman->tanggal_pengembalian = Carbon::parse($peminjaman->tanggal_peminjaman)->addDays(7);
            }
        });
    }
}

