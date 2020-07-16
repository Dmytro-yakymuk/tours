<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComsComtPlusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coms_comt_pluses', function (Blueprint $table) {
            $table->increments('id');
 
            $table->integer('comment_id')->unsigned()->default(1);
            $table->foreign('comment_id')->references('id')->on('comments');
            
            $table->integer('comment_plus_id')->unsigned()->default(1);
            $table->foreign('comment_plus_id')->references('id')->on('comment_pluses');

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
        Schema::dropIfExists('coms_comt_pluses');
    }
}
