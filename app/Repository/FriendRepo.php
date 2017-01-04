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
            $exists = Friend::whereFromUid($from_uid)->whereToUid($to_uid)->whereType($type)->count();
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
            Friend::whereId($id)->update(['status'=>1]);
            return apiSuccess('您已成功'.$type_message);
        }elseif($request == 'reject'){
            Friend::whereId($id)->update(['status'=>-1]);
            return apiSuccess('您已拒绝'.$type_message);
        }
    }
    
    public static function getMineFriendList($uid)
    {
        return self::getList($uid,1,1);
    }
    
    public static function getMyFriendRequest($uid)
    {
        return self::getList($uid,0,1);
    }
    
    public static function getMyStrengthRequest($uid)
    {
        return self::getList($uid,0,2);
    }
    
    private static function getList($uid,$status,$type)
    {
        $reqs = Friend::whereToUid($uid)->whereStatus($status)->type($type)->pluck('from_uid');
        if($reqs->isEmpty())return [];
        foreach ($reqs as $v) {
            $list[]=UserRepo::getUserSimpleInfo($v);
        }
        return $list;
    }

}