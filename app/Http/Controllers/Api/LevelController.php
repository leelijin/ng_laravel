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

        $star_level_info = LevelRepo::getLevelList(1,$current_level,$page,$limit);
        
        return apiSuccess(compact('current_level','star_level_info'));
    }
    
    public function starQuestions()
    {
        $page = $this->request->has('page')?$this->params['page']:1;
        $limit = $this->request->has('limit')?$this->params['limit']:10;
        return Question::whereLevelId($this->params['star_id'])->take($limit)->offset(($page - 1) * $limit)->get();
    }
    
    public function goldList()
    {
        $page = $this->request->has('page')?$this->params['page']:1;
        $limit = $this->request->has('limit')?$this->params['limit']:10;
    
        $current_level=User::whereId($this->uid)->value('current_star_level');
    
        $gold_level_info = LevelRepo::getLevelList(2,$current_level,$page,$limit);
    
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
