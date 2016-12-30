<?php

/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/29
 * Time: 16:30
 */
class Test
{
    public function judgeTime($current_day,$current_hour,$current_minutes)
    {
        if (30 != $current_day && 31 != $current_day&& 1 != $current_day) return false;
        if (1!=$current_day && $current_hour < 18) return false;
        if($current_day ==1 && $current_hour>=1)return false;
        if ($current_minutes > 20 || $current_minutes < 10) return false;
        return true;
    }
    
    public function index()
    {
        $error=[];
        $data =[
            [30,18,00,false],
            [30,18,15,true],
            [30,20,21,false],
            [30,23,00,false],
            [30,23,12,true],
            [30,23,21,false],
            [31,00,00,false],
            [31,2,00,false],
            [31,18,00,false],
            [31,18,11,true],
            [31,23,00,false],
            [31,23,11,true],
            [1,0,00,false],
            [1,0,11,true],
            [1,0,21,false],
            [1,1,21,false],
        ];
        foreach ($data as $v) {
            $result = $this->judgeTime($v[0],$v[1],$v[2]);
            if($result!=$v[3]){
                $error[]=$v;
            }
        }
        print_r($error);exit;
    }
}

(new Test())->index();