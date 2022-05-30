<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('nik', 25)->unique()->nullable();
            $table->string('nip', 25)->unique()->nullable();
            $table->string('no_hp', 25)->unique()->nullable();
            $table->text('alamat')->nullable();
            $table->string('password');
            $table->text('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
