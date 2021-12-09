<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('action_id')->nullable();
            $table->string('patch')->unique()->nullable();
            $table->string('position')->nullable();
            $table->timestamps();

            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_images');
    }
}
