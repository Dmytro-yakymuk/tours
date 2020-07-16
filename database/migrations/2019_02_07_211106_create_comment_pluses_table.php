<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentPlusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_pluses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->boolean('position')->nullable();
            $table->boolean('public')->nullable();
            $table->integer('language_id')->unsigned()->default(1);
            $table->foreign('language_id')->references('id')->on('languages');

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
        Schema::drop('comment_pluses');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
