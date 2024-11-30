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
        Schema::create('riwayat_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_masuk_id')->constrained('surat_masuks')->onDelete('cascade');
            $table->string('nama_ormawa')->nullable(); // Izinkan kosong
            $table->date('tanggal_surat_masuk_keluar');
            $table->string('kategori');
            $table->string('nomor_surat');
            $table->string('jenis_surat');
            $table->string('nama_kegiatan');
            $table->string('penanggung_jawab');
            $table->string('file_surat');
            $table->enum('status', ['Ditolak', 'Disetujui']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_surats');
    }
};
