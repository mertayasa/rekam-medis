<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlYoutubeToOpsiIntervensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opsi_intervensi', function (Blueprint $table) {
            $table->string('url_youtube')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opsi_intervensi', function (Blueprint $table) {
            $table->dropColumn('url_youtube');
        });
    }
}
