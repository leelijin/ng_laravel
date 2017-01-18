<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/4
 * Time: 22:02
 */

namespace App\Repository;


use App\Models\Level;

class LevelRepo
{
    public static function getLevelList($type,$current_level = 0,$page = 1,$limit = 10)
    {
        //根据等级修正关卡
        if ($current_level > 10) {
            $page = (int)($current_level / 10) + $page;
        }
        $level_info = Level::$type()->take($limit)->offset(($page - 1) * $limit)->get();
        if($level_info->isEmpty())return [];
        $i = 1 * ($page - 1) * $limit + 1;
        foreach ($level_info as &$v) {
            $v->num = $i;
            $i++;
        }
        return $level_info;
    }
    
    public static function submitLevel($id,$type)
    {
        
    }
    
}