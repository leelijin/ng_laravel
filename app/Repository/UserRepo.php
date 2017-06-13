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
    public static function getUserSimpleInfo($uid,$query=[])
    {
        return User::where('id',$uid)->where($query)->simple()->first();
    }
    
    public static function getUserStrength($uid)
    {
        return User::whereId($uid)->value('strength');
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
    
    /**
     * 统一为用户增加金币入口
     * @param $uid
     * @param $gold
     */
    public static function increUserGold($uid,$gold)
    {
        $userModel = User::whereId($uid);
        $max_gold = 0;
        
        if($max_gold > 0){
            $current_gold = $userModel->value('gold');
            if($current_gold >=$max_gold){//体力值已满
                return false;
            }elseif($current_gold + $gold >=$max_gold){
                $userModel->update(['gold',$max_gold]);
            }else{
                $userModel->increment('gold',$gold);
            }
        }else{
            $userModel->increment('gold',$gold);
        }
        return true;
        
    }
    
    public static function getUserWrongAuth($uid)
    {
        return User::whereId($uid)->value('wrong_pay');
    }
    public static function setUserWrongAuth($uid)
    {
        return User::whereId($uid)->update(['wrong_pay'=>1]);
    }
    
    public static function submitMood($uid,$mood)
    {
        return User::whereId($uid)->update(['mood'=>$mood]);
    }
    
    
    
}