<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('time')->nullable();
            $table->date('date')->nullable();
            $table->integer('price')->nullable();
            $table->unsignedBigInteger('hall_id')->nullable();
            $table->unsignedBigInteger('movie_id')->nullable();
            $table->timestamps();

            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tables');
    }
}
