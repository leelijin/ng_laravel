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
        $info['link']=getCurrentAndroidDownloadLink();
        $info['version']=1;
        return apiSuccess($info);
    }
    
    public function notice()
    {
        $announce=Notice::take(2)->get()?:[];
        if($this->request->has('uid')){
            $friend_requests=FriendRepo::getMyFriendRequest($this->uid);
            //$friend_strength=FriendRepo::getMyStrengthRequest($this->uid);
            //$friend_requests=[];
            $friend_strength=[];
        }else{
            $friend_requests=$friend_strength=[];
        }
        
        return apiSuccess(compact('announce','friend_requests','friend_strength'));
    }
    
}