<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubIntervensiIdToOpsiIntervensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opsi_intervensi', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_intervensi_id')->nullable();
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
            $table->dropColumn('sub_intervensi_id');
        });
    }
}
