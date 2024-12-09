<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSurat extends Model
{
    protected $table = 'riwayat_surats';
    // Tabel yang digunakan

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'surat_masuk_id',
        'surat_keluar_id',
        'nama_pengirim',
        'tanggal_surat_masuk_keluar',
        'kategori',
        'nomor_surat',
        'jenis_surat',
        'nama_kegiatan',
        'penanggung_jawab',
        'file_surat',
        'nominal_dana',
        'status',
        'tanggal_diedit',
        'nominal_dana_disetujui'
    ];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class);
    }
    
    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class);
    }

    
}
