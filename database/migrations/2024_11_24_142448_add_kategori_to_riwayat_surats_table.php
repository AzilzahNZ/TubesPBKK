<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriToRiwayatSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menambahkan kolom kategori hanya jika kolom tersebut belum ada
        if (!Schema::hasColumn('riwayat_surats', 'kategori')) {
            Schema::table('riwayat_surats', function (Blueprint $table) {
                $table->string('kategori')->after('tanggal_surat_masuk_keluar'); // Menambah kolom kategori
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_surats', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
}
