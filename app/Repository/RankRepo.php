<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/4
 * Time: 21:18
 */

namespace App\Repository;


use App\Models\User;

class RankRepo
{
    public static function getRank($classify,$friendship=false,$uid=0)
    {
        $query = User::$classify();
        if($friendship&&$uid){
            $friends = FriendRepo::getMineFriendUid($uid);
            $query = $query->whereIn('id',$friends);
        }
        return $query->get();
    }
}