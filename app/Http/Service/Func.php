<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/30
 * Time: 10:48
 */

namespace App\Http\Service;


class Func
{
    /**
     * create_rand随机生成一个字符串
     * @param int $length 字符串的长度
     * @param string $type 类型
     * @return string
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    public static function create_rand($length = 8, $type = 'all')
    {
        $num = '0123456789';
        $letter = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($type == 'num') {
            $chars = $num;
        } elseif ($type == 'letter') {
            $chars = $letter;
        } else {
            $chars = $letter . $num;
        }
        
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
        
    }
    
    public static function default_avatar()
    {
        return 'http://lorempixel.com/80/80/?70570';
    }
}