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
    
    /**
     * 统一为用户增加体力入口
     * @param $uid
     * @param $strength
     */
    public static function increUserStrength($uid,$strength)
    {
        $userModel = User::whereId($uid);
        $max_strength = 100;
        $current_strength = $userModel->value('strength');
        if($current_strength >=$max_strength){//体力值已满
            return false;
        }elseif($current_strength + $strength >=$max_strength){
            $userModel->update(['strength',$max_strength]);
        }else{
            $userModel->increment('strength',$strength);
        }
        return true;
        
        
        
    }
    
}