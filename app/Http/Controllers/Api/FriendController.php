<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Repository\FriendRepo;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    protected $friendRepo;
    
    public function add()
    {
        return FriendRepo::triggerRequest($this->uid,$this->params['to_uid'],1,'添加好友');
    }
    
    public function handle()
    {
        return FriendRepo::handleRequest($this->params['id'],$this->uid,$this->params['request'],1,'添加好友');
    }
    
    public function strengthRequest()
    {
        return FriendRepo::triggerRequest($this->uid,$this->params['to_uid'],2,'体力');
    }
    
    public function strengthHandle()
    {
        return FriendRepo::handleRequest($this->params['id'],$this->uid,$this->params['request'],2,'赠送体力');
    }
    
    public function mine()
    {
        return apiSuccess(FriendRepo::getMineFriendList($this->uid,$this->page,$this->limit,$this->request->has('key')?$this->params['key']:''));
    }
    
    public function info($friend_uid)
    {
        $userInfo = User::base()->find($friend_uid);
        return $userInfo?apiSuccess($userInfo):apiError(1,'无此用户');
    }
}
