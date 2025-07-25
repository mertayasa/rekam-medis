<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiagnosaMedisToPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->string('diagnosa_medis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->dropColumn('diagnosa_medis');
        });
    }
}
