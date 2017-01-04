<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\RankRepo;

class LevelController extends Controller
{
    
    public function starList()
    {
        $current_level=User::whereId($this->uid)->value('current_star_level');
        $star_level_info ;
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
