<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNominalDanaToRiwayatPengajuanSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_pengajuan_surats', function (Blueprint $table) {
            $table->unsignedBigInteger('nominal_dana')->nullable()->after('file_surat')->comment('Nominal dana yang diajukan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn('nominal_dana');
        });
    }
}
