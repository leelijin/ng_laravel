<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Question;
use App\Models\QuestionWrong;
use App\Models\User;
use App\Repository\LevelRepo;
use App\Repository\RankRepo;
use App\Repository\UserRepo;

class LevelController extends Controller
{
    
    public function starList()
    {
        $limit = $this->request->has('limit')?$this->limit:10;
        
        $current_level=User::whereId($this->uid)->value('current_star_level');

        $star_level_info = LevelRepo::getLevelList('star',$current_level,$this->page,$limit);
        
        return apiSuccess(compact('current_level','star_level_info'));
    }
    
    public function goldList()
    {
        $page = $this->request->has('page')?$this->params['page']:1;
        $limit = $this->request->has('limit')?$this->params['limit']:10;
        
        $current_level=User::whereId($this->uid)->value('current_gold_level');
        
        $gold_level_info = LevelRepo::getLevelList('gold',$current_level,$page,$limit);
        
        foreach ($gold_level_info as &$v) {
            $v->challenge_times=0;
        }
        
        return apiSuccess(compact('current_level','gold_level_info'));
    }
    
    public function starDetail()
    {
        $conditionDown = LevelRepo::checkUserCondition($this->uid,$this->params['star_id'],1);
        if($conditionDown)return $conditionDown;
        $model = Question::whereLevelId($this->params['star_id']);
        if($this->request->has('limit') && $this->params['limit']!=0){
            $model = $model->take($this->limit)->offset(($this->page - 1) * $this->limit);
        }
        $list = $model->get();
        return apiSuccess($list);
    }
    
    public function starDetailJudge()
    {
        $conditionDown = LevelRepo::checkUserCondition($this->uid,$this->params['star_id'],1);
        if($conditionDown)return $conditionDown;
        return apiSuccess(['message'=>'条件通过','user_strength'=>UserRepo::getUserStrength($this->uid)]);
    }
    
    public function goldDetail()
    {
        $check = LevelRepo::checkUserCondition($this->uid,$this->params['gold_id'],2);
        if($check)return $check;
        $model = Question::whereLevelId($this->params['gold_id']);
        if($this->request->has('limit') && $this->params['limit']!=0){
            $model = $model->take($this->limit)->offset(($this->page - 1) * $this->limit);
        }
        $list = $model->get();
        return apiSuccess($list);
    }
    
    public function goldDetailJudge()
    {
        $check = LevelRepo::checkLevelUser($this->uid,$this->params['gold_id'],2);
        if($check)return $check;
        return apiSuccess(['message'=>'条件通过','user_strength'=>UserRepo::getUserStrength($this->uid)]);
    }
    
    public function rankStar()
    {
        $list = RankRepo::getRank('TopStar',$this->limit);
        return apiSuccess($list);
    }
    
    public function rankStarFriends()
    {
        $list = RankRepo::getRank('TopStar',$this->limit,true,$this->uid);
        return apiSuccess($list);
    }
    
    public function rankGold()
    {
        $list = RankRepo::getRank('TopGold',$this->limit);
        return apiSuccess($list);
    }
    
    public function rankGoldFriends()
    {
        $list = RankRepo::getRank('TopGold',$this->limit,true,$this->uid);
        return apiSuccess($list);
    }
    
    public function starSubmit()
    {
        return LevelRepo::submitLevel($this->params['star_id'],1,$this->uid,$this->request->has('wrong_ids')?$this->params['wrong_ids']:[]);
    }
    
    public function goldSubmit()
    {
        return LevelRepo::submitLevel($this->params['gold_id'],2,$this->uid,$this->request->has('wrong_ids')?$this->params['wrong_ids']:[]);
    }
    
    public function mineWrong()
    {
        $list = QuestionWrong::whereUid($this->uid)->orderBy('id','desc')->paginate($this->limit);
        return apiSuccess($list);
    }

}
