<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $incrementing=false;
    public $timestamps=false;
    
    public static function insertLog($request,$response)
    {
        $data = [
            'uid'         => (int)$request->input('uid',0),
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
        self::insert($data);
    }
}
