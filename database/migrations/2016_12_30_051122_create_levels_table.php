<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('need_strength')->unsigned();
            $table->integer('question_number')->unsigned();
            $table->integer('time_limit')->unsigned();
            $table->integer('reward')->unsigned();
            $table->integer('challenge_times')->unsigned();
            $table->tinyInteger('level_type')->unsigned()->comment('1为星级场，2为金币场');
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
        Schema::dropIfExists('levels');
    }
}
