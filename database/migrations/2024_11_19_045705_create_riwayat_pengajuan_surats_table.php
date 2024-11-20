<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_diajukan');
            $table->string('nomor_surat');
            $table->string('jenis_surat');
            $table->string('nama_kegiatan');
            $table->string('penanggung_jawab');
            $table->string('file_surat');
            $table->string('status')->nullable(); // Status bisa kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pengajuan_surats');
    }
};
