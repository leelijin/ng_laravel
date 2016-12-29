<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('level_id');
            $table->unsignedTinyInteger('level_type')->comment('1为星级场，2为金币场');
            $table->string('title',20)->comment('问题标题');
            $table->string('content')->comment('问题描述');
            $table->string('image1');
            $table->string('image2');
            $table->string('answer_options')->comment('问题选项');
            $table->enum([0,1,2,3])->comment('正确答案');
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
        Schema::dropIfExists('question');
    }
}
