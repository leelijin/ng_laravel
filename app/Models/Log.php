<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Log
 *
 * @property int $uid
 * @property string $method
 * @property string $client
 * @property string $device_id
 * @property string $version 版本号
 * @property string $url
 * @property string $ip
 * @property int $create_time
 * @property string $params
 * @property int $code
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereUid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereMethod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereClient($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereDeviceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereCreateTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereParams($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Log whereCode($value)
 * @mixin \Eloquent
 */
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
