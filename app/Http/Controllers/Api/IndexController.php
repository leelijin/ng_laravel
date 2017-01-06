<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/28
 * Time: 11:13
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Repository\FriendRepo;
use App\Services\Api;
use App\Models\StartAd;

class IndexController extends Controller
{
    
    public function startAd()
    {
        $info = StartAd::first();
        return Api::apiSuccess($info);
    }
    
    public function notice()
    {
        $announce=Notice::first()?:[];
        $announce['cover']=config('app.url').'/public/img/notice_header.png';
        if($this->request->has('uid')){
            $friend_requests=FriendRepo::getMyFriendRequest($this->uid);
            $friend_strength=FriendRepo::getMyStrengthRequest($this->uid);
        }else{
            $friend_requests=$friend_strength=[];
        }
        
        return Api::apiSuccess(compact('announce','friend_requests','friend_strength'));
    }
    
}