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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('tanggal_diajukan');
            $table->string('nomor_surat');
            $table->string('jenis_surat');
            $table->string('nama_kegiatan');
            $table->string('penanggung_jawab');
            $table->string('file_surat');
            $table->bigInteger('nominal_dana')->nullable(); // Nominal dana, opsional
            $table->enum('status', ['Ditolak', 'Disetujui', 'Diproses', 'Selesai', 'Dibatalkan', 'Direvisi'])->default('Diproses');
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
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->dropColumn('tanggal_diedit');
        });
    }
};
