<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    public static function insertLog($request,$response)
    {
        $data = [
            'uid'         => $request->input('uid',0),
            'method'      => $request->method(),
            'client'      => $request->input('client','others'),
            'device_id'   => $request->input('device_id',''),
            'version'     => $request->input('version',0),
            'url'         => $request->url(),
            'ip'          => $request->ip(),
            'create_time' => time(),
            'params'       => json_encode($request->all()),
            'code'        => $response->getStatusCode(),
        ];
        DB::table('logs')->insert($data);
    }
}
