<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('riwayat_surats', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }

    public function down()
    {
        Schema::table('riwayat_surats', function (Blueprint $table) {
            $table->string('nama_ormawa')->nullable();
        });
    }
};
