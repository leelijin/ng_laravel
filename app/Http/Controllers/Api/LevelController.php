<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Question;
use App\Models\QuestionWrong;
use App\Models\User;
use App\Repository\LevelRepo;
use App\Repository\RankRepo;

class LevelController extends Controller
{
    
    public function starList()
    {
        $page = $this->request->has('page')?$this->params['page']:1;
        $limit = $this->request->has('limit')?$this->params['limit']:10;
        
        $current_level=User::whereId($this->uid)->value('current_star_level');

        $star_level_info = LevelRepo::getLevelList('star',$current_level,$page,$limit);
        
        return apiSuccess(compact('current_level','star_level_info'));
    }
    
    public function starQuestion()
    {
        $model = Question::whereLevelId($this->params['star_id']);
        if($this->request->has('limit')){
            $model = $model->take($this->limit)->offset(($this->page - 1) * $this->limit);
        }
        $list = $model->get();
        return apiSuccess($list);
    }
    
    public function goldQuestion()
    {
        $model = Question::whereLevelId($this->params['gold_id']);
        if($this->request->has('limit')){
            $model = $model->take($this->limit)->offset(($this->page - 1) * $this->limit);
        }
        $list = $model->get();
        return apiSuccess($list);
    }
    
    public function goldList()
    {
        $page = $this->request->has('page')?$this->params['page']:1;
        $limit = $this->request->has('limit')?$this->params['limit']:10;
    
        $current_level=User::whereId($this->uid)->value('current_star_level');
    
        $gold_level_info = LevelRepo::getLevelList('gold',$current_level,$page,$limit);
    
        foreach ($gold_level_info as &$v) {
            $v->challenge_times=0;
        }
    
        return apiSuccess(compact('current_level','gold_level_info'));
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
        //检查是否存在
        $info = Level::find($this->params['star_id']);
        if(!$info)return apiError(1,'此关卡不存在,请检查');
        
        if($this->request->has('wrong_ids')){
            //录入到错题库
            $wrong_ids = explode(',',$this->params['wrong_ids']);
            if(is_array($wrong_ids)){
                foreach ($wrong_ids as $v) {
                    $params = ['uid'=>$this->uid,'question_id'=>$v,'type'=>1];
                    if(Question::find($v) && !QuestionWrong::where($params)->first()){
                        QuestionWrong::create($params);
                    }
                }
                return apiSuccess('成功增加错题');
            }
        }else{
            //关卡通关
            $re = User::whereId($this->uid)->increment('star');
            return $re?apiSuccess('恭喜通关'):apiError(1,'通关出错，请重试');
        }
        
    }
    
    public function goldSubmit()
    {
        //检查是否存在
        $info = Level::find($this->params['gold_id']);
        if(!$info)return apiError(1,'此关卡不存在,请检查');
    
        if($this->request->has('wrong_ids')){
            //录入到错题库
            $wrong_ids = explode(',',$this->params['wrong_ids']);
            if(is_array($wrong_ids)){
                foreach ($wrong_ids as $v) {
                    $params = ['uid'=>$this->uid,'question_id'=>$v,'type'=>2];
                    if(Question::find($v) && !QuestionWrong::where($params)->first()){
                        QuestionWrong::create($params);
                    }
                }
                return apiSuccess('成功增加错题');
            }
        }else{
            //关卡通关
            $re = User::whereId($this->uid)->increment('gold');
            return $re?apiSuccess('恭喜通关'):apiError(1,'通关出错，请重试');
        }
    }
    
    public function mineWrong()
    {
        $list = QuestionWrong::whereUid($this->uid)->orderBy('id','desc')->paginate($this->limit);
        return apiSuccess($list);
    }

}
