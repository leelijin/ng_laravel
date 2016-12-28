<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'uid'         => 0,
            'method'      => 'post',
            'client'      => 'others',
            'device_id'   => '',
            'version'     => 0,
            'url'         => '',
            'ip'          => '',
            'create_time' => time(),
            'params'       => '',
            'code'        => 0,
        ];
        DB::table('logs')->insert($data);
    }
}
