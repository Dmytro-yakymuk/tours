<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_services', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tour_id')->unsigned()->default(1);
            $table->foreign('tour_id')->references('id')->on('tours');

            $table->integer('service_id')->unsigned()->default(1);
            $table->foreign('service_id')->references('id')->on('services');

            $table->integer('price')->unsigned()->default(0);

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
        Schema::dropIfExists('tour_services');
    }
}
