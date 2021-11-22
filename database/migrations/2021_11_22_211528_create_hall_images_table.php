<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hall_id')->nullable();
            $table->string('patch')->unique()->nullable();
            $table->string('position')->nullable();
            $table->timestamps();

            $table->foreign('hall_id')->references('id')->on('halls')->cascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hall_images');
    }
}
