<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('idProfile');
            $table->unsignedInteger('idUser');
            $table->foreign('idUser')->references('idUser')->on('user')->onDelete('cascade');
            $table->string('company', 255)->nullable(true);
            $table->string('position', 100)->nullable(true);
            $table->text('aboutMe')->nullable(true);
            $table->string('photo', 255)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
