<?php

namespace App\Http\Controllers\Api;

use App\Friend;
use App\Services\Api;
use App\User;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    
    public function add()
    {
        $check_user = User::find($this->params['to_uid']);
        if($check_user){
            $exists = Friend::where('from_uid',$this->uid)->where('to_uid',$this->params['to_uid'])->count();
            if(!$exists){
                $re = Friend::create(['from_uid'=>$this->uid,'to_uid'=>$this->params['to_uid'],'type'=>1]);
                if($re)return Api::apiSuccess('成功发送添加好友请求');
            }
            return Api::apiError(1,'已发送请求');
        }
        return Api::apiError(1,'对方不存在');
    }
    
    public function handle()
    {
        //检查是否有此请求
        $request = Friend::where([['id',$this->params['id']],['to_uid',$this->uid],['type',1],['status',0]])->first();
        if(!$request)return Api::apiError(1,'请求不存在');
        
        if($this->params['request'] == 'accept'){
            Friend::where('id',$this->params['id'])->update(['status'=>1]);
            return Api::apiSuccess('您已成功添加好友');
        }elseif($this->params['request'] == 'reject'){
            Friend::where('id',$this->params['id'])->update(['status'=>-1]);
            return Api::apiSuccess('您已拒绝添加好友');
        }
    }
    
    public function strengthRequest()
    {
        $check_user = User::find($this->params['to_uid']);
        if($check_user){
            $exists = Friend::where('from_uid',$this->uid)->where('to_uid',$this->params['to_uid'])->count();
            if(!$exists){
                $re = Friend::create(['from_uid'=>$this->uid,'to_uid'=>$this->params['to_uid'],'type'=>2]);
                if($re)return Api::apiSuccess('成功发送体力请求');
            }
            return Api::apiError(1,'已发送请求');
        }
        return Api::apiError(1,'对方不存在');
    }
    
    public function strengthHandle()
    {
        //检查是否有此请求
        $request = Friend::where([['id',$this->params['id']],['to_uid',$this->uid],['type',2],['status',0]])->first();
        if(!$request)return Api::apiError(1,'请求不存在');
        
        if($this->params['request'] == 'accept'){
            Friend::where('id',$this->params['id'])->update(['status'=>1]);
            return Api::apiSuccess('您已成功赠送体力');
        }elseif($this->params['request'] == 'reject'){
            Friend::where('id',$this->params['id'])->update(['status'=>-1]);
            return Api::apiSuccess('您已拒绝赠送体力');
        }
    }
}
