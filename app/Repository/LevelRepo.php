<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/4
 * Time: 22:02
 */

namespace App\Repository;


use App\Models\Level;
use App\Models\Question;
use App\Models\QuestionWrong;
use App\Models\User;
use App\Models\UserQuestion;
use Illuminate\Support\Facades\DB;

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
    
    public static function submitLevel($id,$type,$uid,$wrong_ids=[],$pass_ids=[])
    {
        if($type == 2){
            //检查是否存在
            $info = Level::find($id);
            if(!$info)return apiError(1,'此关卡不存在,请检查');
        }
        
        if($wrong_ids){
            //录入到错题库
            $wrong_ids = explode(',',$wrong_ids);
            if(is_array($wrong_ids)){
                foreach ($wrong_ids as $v) {
                    $params = ['uid'=>$uid,'question_id'=>$v,'type'=>$type];
                    if(Question::find($v) && !QuestionWrong::where($params)->first()){
                        QuestionWrong::create($params);
                    }
                }
                return apiError(1,'挑战失败,再接再厉吧');
            }else{
                $params = ['uid'=>$uid,'question_id'=>$wrong_ids,'type'=>$type];
                if(Question::find($wrong_ids) && !QuestionWrong::where($params)->first()){
                    QuestionWrong::create($params);
                }
            }
        }else{
            //关卡通关
            DB::beginTransaction();
            User::whereId($uid)->increment($type==1?'current_star_level':'current_gold_level');
            //保存关卡 无尽模式使用
            if($pass_ids){
                $pass_ids = explode(',',$pass_ids);
                if(is_array($pass_ids))UserRepo::passLevel($uid,$pass_ids);
            }
            
            //星级奖励
            $reward = $type == 1 ? 1 : $info['reward'];
            UserRepo::rewardUser($uid,$reward);
            DB::commit();
            return apiSuccess('恭喜通关');
            
            
            
        }
    }
    

    
    public static function checkUserCondition($uid,$id,$type)
    {
        return false;
        $type_name = $type == 1?'star':'gold';
        $userInfo = User::whereId($uid)->select(['strength','current_'.$type_name.'_level as current_level'])->first();
        
        $levelNum = self::getLevelNum($id,$type);
        if($userInfo->current_level>$levelNum){
            //获取已通关
            return false;
        }elseif($userInfo->current_level + 1<=$levelNum){
            //检查跳级获取
            return apiError(1,'必须先完成之前的关卡');
        }else{
            //检查用户体力余额是否足够
            $levelStrength = Level::whereId($id)->value('need_strength');
            if($userInfo->strength<$levelStrength)return apiError(1,'用户体力不足');
            //扣减体力
            $dec = User::whereId($uid)->decrement('strength',$levelStrength);
            if(!$dec)return apiError(1,'扣减体力错误');
        }
        
        
    }
    
    public static function getLevelNum($level_id,$type)
    {
        //查询等级排位： 之前有多少条数据 + 1  = 当前数据排位
        $levelCount = Level::where('id','<=',$level_id)->whereLevelType($type)->whereStatus(1)->count();
        return $levelCount;
    }
    
    public static function getUserCurrentGoldLevelId($current_gold_level)
    {
        $current_gold_level = $current_gold_level>=0?$current_gold_level:0;
        return  Level::whereLevelType(2)->whereStatus(1)->limit(1)->offset($current_gold_level)->value('id');
    }
    
}