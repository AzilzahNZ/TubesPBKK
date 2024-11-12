<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'pengunjungs';
    protected $fillable = [
        'no_hp',
        'jenis_kelamin',
        'alamat',
    ];

    // Relasi One-to-Many dengan Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}