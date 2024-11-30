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
            if (!Schema::hasColumn('riwayat_surats', 'nama_ormawa')) {
                $table->string('nama_ormawa')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('riwayat_surats', function (Blueprint $table) {
            if (Schema::hasColumn('riwayat_surats', 'nama_ormawa')) {
                $table->dropColumn('nama_ormawa');
            }
        });
    }
};
