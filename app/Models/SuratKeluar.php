<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluars';
    // Tabel yang digunakan

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'user_id',
        'tanggal_dikeluarkan',
        'nomor_surat',
        'jenis_surat',
        'nama_kegiatan',
        'penanggung_jawab',
        'file_surat',
    ];

    // Relasi dengan User (One-to-Many)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function riwayatSurat()
    {
        return $this->hasOne(RiwayatSurat::class, 'surat_masuk_id');
    }
}
