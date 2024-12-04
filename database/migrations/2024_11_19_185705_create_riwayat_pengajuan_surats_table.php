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
            if (!Schema::hasColumn('riwayat_pengajuan_surats', 'nominal_dana')) {
                $table->bigInteger('nominal_dana')->unsigned()->nullable()->comment('Nominal dana yang diajukan');
            }
            $table->enum('status', ['Ditolak', 'Disetujui', 'Diproses', 'Selesai', 'Direvisi'])->default('Diproses');
            $table->timestamp('tanggal_diedit')->nullable();
            $table->decimal('nominal_dana_disetujui', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn('tanggal_diedit');
            $table->dropColumn('nominal_dana_disetujui');
        });
    }
};
