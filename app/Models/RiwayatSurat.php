<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSurat extends Model
{
    protected $table = 'riwayat_surats';
    // Tabel yang digunakan

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'nama_ormawa',
        'tanggal_surat_masuk_keluar',
        'kategori',
        'nomor_surat',
        'jenis_surat',
        'nama_kegiatan',
        'penanggung_jawab',
        'file_surat',
        'status',
    ];
}
