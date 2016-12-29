<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->char('mobile',11);
            $table->string('avatar');
            $table->string('nickname',20);
            $table->softDeletes();
            $table->timestamps();
            $table->unique('uid');
            $table->unique('mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    
    }
}
