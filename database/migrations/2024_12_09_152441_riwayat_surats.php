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
            $table->foreignId('surat_masuk_id')->nullable()->constrained('surat_masuks')->onDelete('cascade');
            $table->foreignId('surat_keluar_id')->nullable()->constrained('surat_keluars')->onDelete('cascade');
            $table->string('nama_pengirim')->nullable(); // Izinkan kosong
            $table->date('tanggal_surat_masuk_keluar');
            $table->string('kategori');
            $table->string('nomor_surat');
            $table->string('jenis_surat');
            $table->string('nama_kegiatan');
            $table->string('penanggung_jawab');
            $table->string('file_surat');
            $table->string('nominal_dana')->nullable();
            $table->enum('status', ['Ditolak', 'Disetujui', 'Selesai', 'Dibatalkan']);
            $table->timestamp('tanggal_diedit')->nullable();
            $table->decimal('nominal_dana_disetujui', 15, 2)->nullable();
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
