<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_id')->unsigned();
            $table->unsignedTinyInteger('level_type')->comment('1为星级场，2为金币场');
            $table->string('title')->comment('标题');
            $table->string('content')->comment('描述');
            $table->string('image1');
            $table->string('image2');
            $table->string('answer_options')->comment('问题选项');
            $table->enum('right_answer',[0,1,2,3])->comment('正确答案');
            $table->timestamps();
            //与level表关联
            $table->foreign('level_id')->references('id')
                ->on('levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('levels', function(Blueprint $tabel){
            $tabel->dropForeign('levels_level_id_foreign');
        });
        Schema::dropIfExists('questions');
    }
}
