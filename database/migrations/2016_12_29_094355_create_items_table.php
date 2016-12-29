<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items',function(Blueprint $table){
            $table->increments('id');
            $table->string('title',20)->comment('道具名称');
            $table->unsignedInteger('need_gold')->comment('需要金币');
            $table->string('setting')->comment('道具效果设置');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
