<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengajuanSurat extends Model
{
    protected $table = 'riwayat_pengajuan_surats';
    // Tabel yang digunakan

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'user_id',
        'surat_masuk_id',
        'nama_ormawa',
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
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan SuratMasuk (Many-to-One)
    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }
}
