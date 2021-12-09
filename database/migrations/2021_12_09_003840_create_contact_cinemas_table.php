<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCinemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_cinemas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unsigned();
            $table->text('description');
            $table->text('address');
            $table->string('image', 100)->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->bigInteger('status');
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_cinemas');
    }
}
