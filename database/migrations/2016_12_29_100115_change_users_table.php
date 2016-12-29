<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->unsignedSmallInteger('rank')->comment('等级');
            $table->unsignedSmallInteger('gold')->comment('金币');
            $table->unsignedSmallInteger('star')->comment('星级');
            $table->unsignedSmallInteger('strength')->comment('体力');
            $table->unsignedSmallInteger('current_star_level')->comment('当前星级场关卡');
            $table->unsignedSmallInteger('current_gold_level')->comment('当前金币场关卡');
            $table->char('token',40);
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
