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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengunjung_id')->constrained('pengunjungs')->OnDelete('cascade');
            $table->foreignId('buku_id')->constrained('katalog__bukus')->OnDelete('cascade');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
