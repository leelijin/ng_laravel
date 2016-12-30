<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/29
 * Time: 13:32
 */

namespace App\Services;


class Api
{
    private static function apiReturn($data,$code,$message) {
        $result['error_code'] = $code?:0;
        $result['message']=$message?:'';
        $result['data']=$data?:[];
        return $result;
    }
    
    public static function apiSuccess($data,$message='请求成功') {
        if(is_string($data))$data=['message'=>$data];
        return self::apiReturn($data, 0, $message);
    }
    
    public static function apiError($error_code=1,$message='') {
        if(!is_numeric($error_code))exception('错误码应该是一个数字');
        return self::apiReturn([], $error_code,$message);
    }
}