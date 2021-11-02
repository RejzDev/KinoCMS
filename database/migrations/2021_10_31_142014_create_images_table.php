<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('key_img')->nullable();
            $table->string('patch')->unique()->nullable();
            $table->string('position')->nullable();
            $table->timestamps();


            $table->foreign('key_img')->references('id')->on('actions')->cascade('delete');
            $table->foreign('key_img')->references('id')->on('pages')->cascade('delete');
            $table->foreign('key_img')->references('id')->on('news')->cascade('delete');
            $table->foreign('key_img')->references('id')->on('halls')->cascade('delete');
            $table->foreign('key_img')->references('id')->on('movies')->cascade('delete');
            $table->foreign('key_img')->references('id')->on('cinemas')->cascade('delete');
            $table->foreign('key_img')->references('id')->on('banners')->cascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
