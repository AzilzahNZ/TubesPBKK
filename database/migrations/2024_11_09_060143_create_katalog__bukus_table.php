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
        Schema::create('katalog__bukus', function (Blueprint $table) {
            $table->id();
            $table->binary('cover');
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('tahun_terbit');
            $table->enum('genre', ['action', 'adventure', 'comedy', 'drama', 'fantasy', 'horror', 'mystery', 'romance', 'sci-fi', 'thriller', 'western']);
            $table->text('sinopsis');
            $table->integer('stok');
            $table->enum('status', ['tersedia', 'tidak tersedia']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalog__bukus');
    }
};
