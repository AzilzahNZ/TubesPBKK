<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuks';
    // Tabel yang digunakan

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'user_id',
        'tanggal_diajukan',
        'nomor_surat',
        'jenis_surat',
        'nama_kegiatan',
        'penanggung_jawab',
        'file_surat',
        'nominal_dana',
        'status',
        'tanggal_diedit',
        'nominal_dana_disetujui',
    ];

    // Relasi dengan User (One-to-Many)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     // Relasi dengan RiwayatPengajuanSurat (One-to-One)
     public function RiwayatPengajuanSurat()
     {
         return $this->hasOne(RiwayatPengajuanSurat::class, 'surat_masuk_id');
     }

     public function riwayatSurat()
    {
        return $this->hasOne(RiwayatSurat::class, 'surat_masuk_id');
    }
}
