<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlYtIntervensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_yt_intervensi', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('id_intervensi');
            $table->timestamps();

            $table->foreign('id_intervensi')->references('id')->on('intervensi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_yt_intervensi');
    }
}
