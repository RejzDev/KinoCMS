<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('number');
            $table->text('description');
            $table->string('image', 100)->nullable();
            $table->string('banner_img', 100)->nullable();
            $table->string('url', 100);
            $table->string('title', 100);
            $table->string('keywords', 100);
            $table->text('seo_description');
            $table->unsignedBigInteger('cinema_id')->nullable();
            $table->timestamps();

            $table->foreign('cinema_id')->references('id')->on('cinemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls');
    }
}
