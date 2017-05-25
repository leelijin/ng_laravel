<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/1
 * Time: 11:39
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Api\PayController;
use App\Models\Level;
use App\Models\LevelSetting;
use App\Models\Order;
use App\Models\Question;
use App\Models\User;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\DB;

class TestController
{
    public function index()
    {
        //生成题目库
        //for($i=0;$i<40;$i++){
        //    $levelId = Level::insertGetId([
        //        'need_strength'=>10,
        //        'question_number'=>20,
        //        'time_limit'=>600,
        //        'reward'=>10,
        //        'level_type'=>2,
        //        'status'=>1,
        //    ]);
        //    for($j=0;$j<20;$j++){
        //        $arr = ["选项1","选项2","选项3","选项4"];
        //        shuffle($arr);
        //        $answer = mt_rand(0,3);
        //        Question::create([
        //            'level_id'=>$levelId,
        //            'question'=>sprintf('请选择一个正确答案(答案:%s)',self::switchAnswer($answer)),
        //            'content'=>'问题描述：略',
        //            'image1'=>'http://lorempixel.com/750/1000/',
        //            'image2'=>'http://lorempixel.com/750/1000/',
        //            'answer_options'=>$arr,
        //            'right_answer'=>$answer
        //        ]);
        //    }
        //
        //}
        
        
        
    }
    
    private static function switchAnswer($answer)
    {
        switch ($answer){
            case 0:return 'A';
            case 1:return 'B';
            case 2:return 'C';
            case 3:return 'D';
        }
    }
}