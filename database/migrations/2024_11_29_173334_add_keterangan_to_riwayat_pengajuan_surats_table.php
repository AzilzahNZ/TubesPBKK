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
        Schema::table('riwayat_pengajuan_surats', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('riwayat_pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
};