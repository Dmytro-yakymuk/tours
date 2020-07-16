<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->integer('price_discount')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('sold')->nullable();
            $table->text('description');
            $table->text('text');
            $table->string('image')->nullable();
            $table->float('rating')->nullable();
            $table->boolean('root')->nullable();
            $table->boolean('public')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('tours');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
