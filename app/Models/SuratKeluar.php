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
        'tanggal_diajukan',
        'nomor_surat',
        'jenis_surat',
        'nama_kegiatan',
        'penanggung_jawab',
        'file_surat',
        'nominal_dana',
        'status',
        'tanggal_diedit',
    ];

    // Relasi dengan User (One-to-Many)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
