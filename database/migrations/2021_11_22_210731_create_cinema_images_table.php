<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinema_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cinema_id')->nullable();
            $table->string('patch')->unique()->nullable();
            $table->string('position')->nullable();
            $table->timestamps();

            $table->foreign('cinema_id')->references('id')->on('cinemas')->cascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cinema_images');
    }
}
