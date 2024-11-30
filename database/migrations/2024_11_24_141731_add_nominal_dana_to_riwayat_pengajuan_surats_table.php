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
            if (!Schema::hasColumn('riwayat_pengajuan_surats', 'nominal_dana')) {
                $table->unsignedBigInteger('nominal_dana')->nullable()->comment('Nominal dana yang diajukan')->after('file_surat');
            }
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
            if (Schema::hasColumn('riwayat_pengajuan_surats', 'nominal_dana')) {
                $table->dropColumn('nominal_dana');
            }
        });
    }
}
