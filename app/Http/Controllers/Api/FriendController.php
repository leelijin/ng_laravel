<?php

namespace App\Http\Controllers\Api;

use App\Repository\FriendRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return FriendRepo::getMineFriendList($this->uid);
    }
}
