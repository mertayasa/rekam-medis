<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamMedisHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_medis_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rekam_medis');
            $table->string('group');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_rekam_medis')->references('id')->on('rekam_medis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekam_medis_history');
    }
}
