<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Question;
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
    
    public function starQuestions()
    {
        $model = Question::whereLevelId($this->params['star_id']);
        if($this->request->has('limit')){
            $page = $this->request->has('page')?$this->params['page']:1;
            $model = $model->take($this->params['limit'])->offset(($page - 1) * $this->params['limit']);
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
        $list = RankRepo::getRank('TopStar');
        return apiSuccess($list);
    }
    
    public function rankStarFriends()
    {
        $list = RankRepo::getRank('TopStar',true,$this->uid);
        return apiSuccess($list);
    }
    
    public function rankGold()
    {
        $list = RankRepo::getRank('TopGold');
        return apiSuccess($list);
    }
    
    public function rankGoldFriends()
    {
        $list = RankRepo::getRank('TopGold',true,$this->uid);
        return apiSuccess($list);
    }

}
