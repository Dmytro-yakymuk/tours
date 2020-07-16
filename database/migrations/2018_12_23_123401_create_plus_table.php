<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plus', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('room')->unsigned()->default(0);
            $table->boolean('public')->nullable();
            $table->integer('language_id')->unsigned()->default(1);
            $table->foreign('language_id')->references('id')->on('languages');
            $table->integer('tour_id')->unsigned()->default(1);
            $table->foreign('tour_id')->references('id')->on('tours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plus');
    }
}
