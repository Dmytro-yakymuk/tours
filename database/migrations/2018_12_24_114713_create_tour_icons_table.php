<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_icons', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tour_id')->unsigned()->default(1);
            $table->foreign('tour_id')->references('id')->on('tours');

            $table->integer('icon_id')->unsigned()->default(1);
            $table->foreign('icon_id')->references('id')->on('icons');

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
        Schema::dropIfExists('tour_icons');
    }
}
