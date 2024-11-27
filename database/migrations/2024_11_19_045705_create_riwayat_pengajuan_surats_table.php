<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\DB;
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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('surat_masuk_id')->constrained('surat_masuks')->onDelete('cascade');
            $table->timestamp('tanggal_diajukan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('nomor_surat')->default();
            $table->string('jenis_surat')->default();
            $table->string('nama_kegiatan')->default();
            $table->string('penanggung_jawab')->default();
            $table->string('file_surat')->default();
            $table->unsignedBigInteger('nominal_dana')->nullable(); // Nominal dana, opsional
            $table->enum('status', ['Ditolak', 'Disetujui', 'Diproses', 'Selesai'])->default('Diproses');
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
