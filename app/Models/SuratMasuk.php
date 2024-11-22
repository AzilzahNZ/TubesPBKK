<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuks';
    // Tabel yang digunakan

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'tanggal_diajukan',
        'nomor_surat',
        'jenis_surat',
        'nama_kegiatan',
        'penanggung_jawab',
        'file_surat',
        'status',
    ];
}
