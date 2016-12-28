<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('log')){
            Schema::rename('log','logs');
            Schema::table('logs', function (Blueprint $table) {
                $table->renameColumn('param','params');
                $table->dropColumn('model');
                $table->dropColumn('controller');
                $table->dropColumn('action');
            });
        }
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logs');
    }
}
