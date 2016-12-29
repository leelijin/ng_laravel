<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('need_strength');
            $table->unsignedInteger('question_number');
            $table->unsignedInteger('time_limit');
            $table->unsignedInteger('reward');
            $table->unsignedInteger('challenge_times');
            $table->unsignedTinyInteger('level_type')->comment('1为星级场，2为金币场');
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
        Schema::dropIfExists('level');
    }
}
