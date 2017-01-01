<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/1
 * Time: 12:40
 */

namespace App\Repository;


use App\Models\Friend;
use App\Models\User;

class FriendRepo
{
    public static function triggerRequest($from_uid,$to_uid,$type,$type_message)
    {
        
        $check_user = User::find($to_uid);
        if($check_user){
            $exists = Friend::where('from_uid',$from_uid)->where('to_uid',$to_uid)->count();
            if(!$exists){
                $re = Friend::create(['from_uid'=>$from_uid,'to_uid'=>$to_uid,'type'=>$type]);
                if($re)return apiSuccess('成功发送'.$type_message.'请求');
            }
            return apiError(1,'已发送请求');
        }
        return apiError(1,'对方不存在');
    }
    
    public static function handleRequest($id,$uid,$request,$type,$type_message)
    {
        //检查是否有此请求
        $requestInfo = Friend::where([['id',$id],['to_uid',$uid],['type',$type],['status',0]])->first();
        if(!$requestInfo)return apiError(1,'请求不存在');
    
        if($request == 'accept'){
            Friend::where('id',$id)->update(['status'=>1]);
            return apiSuccess('您已成功'.$type_message);
        }elseif($request == 'reject'){
            Friend::where('id',$id)->update(['status'=>-1]);
            return apiSuccess('您已拒绝'.$type_message);
        }
    }
    
    public static function getMineFriendList($uid)
    {
        $reqs = Friend::where('to_uid',$uid)->where('status',1)
            ->pluck('from_uid');
        if($reqs->isEmpty())return [];
        foreach ($reqs as $v) {
            $list[]=UserRepo::getUserSimpleInfo($v);
        }
        return $list;
    }
    
}