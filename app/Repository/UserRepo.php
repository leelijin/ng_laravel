<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/1
 * Time: 13:42
 */

namespace App\Repository;


use App\Models\User;

class UserRepo
{
    public static function getUserSimpleInfo($uid)
    {
        return User::where('id',$uid)->simple()->first();
    }
    
}