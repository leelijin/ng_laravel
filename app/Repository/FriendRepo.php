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
    
    public static function handleRequest($from_uid,$uid,$request,$type,$type_message)
    {
        //检查是否有此请求
        $requestInfo = Friend::where([['from_uid',$from_uid],['to_uid',$uid],['type',$type],['status',0]])->first();
        if(!$requestInfo)return apiError(1,'请求不存在');
    
        if($request == 'accept'){
            Friend::whereId($requestInfo->id)->update(['status'=>1]);
            //为用户增加体力
            $strength = 5;
            
            return apiSuccess('您已成功'.$type_message);
        }elseif($request == 'reject'){
            Friend::whereId($requestInfo->id)->update(['status'=>-1]);
            return apiSuccess('您已拒绝'.$type_message);
        }
    }
    
    public static function getMineFriendUid($uid)
    {
        return self::getList($uid,1,1,true);
    }
    
    public static function getMineFriendList($uid,$page,$limit)
    {
        //单独做分页也是够拼的
        $reqs1 = Friend::whereToUid($uid)->whereStatus(1)->type(1)->pluck('from_uid');
        $reqs2 = Friend::whereFromUid($uid)->whereStatus(1)->type(1)->pluck('to_uid');
        $final_arr = $reqs1->merge($reqs2)->toArray();
        $reqs = array_slice($final_arr,($page-1)*$limit,$limit);
        if(!$reqs)return [];
        $list=[
            'total'=>count($final_arr),
            'current_page'=>$page,
            'last_page'=>(int)(count($final_arr)/$limit + 1),
        ];
        
        foreach ($reqs as $v) {
            $list['data'][]=UserRepo::getUserSimpleInfo($v);
        }
        return $list;
    }
    
    public static function getMyFriendRequest($uid)
    {
        return self::getList($uid,0,1);
    }
    
    public static function getMyStrengthRequest($uid)
    {
        return self::getList($uid,0,2);
    }
    
    private static function getList($uid,$status,$type,$justUid=false)
    {
        $reqs1 = Friend::whereToUid($uid)->whereStatus($status)->type($type)->pluck('from_uid');
        $reqs2 = Friend::whereFromUid($uid)->whereStatus($status)->type($type)->pluck('to_uid');
        $reqs = $reqs1->merge($reqs2);
        if($reqs->isEmpty())return [];
        if($justUid)return $reqs;
        
        foreach ($reqs as $v) {
            $list[]=UserRepo::getUserSimpleInfo($v);
        }
        return $list;
    }

}