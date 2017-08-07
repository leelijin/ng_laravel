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
            $exists=0;
            $exists += Friend::whereFromUid($from_uid)->whereToUid($to_uid)->whereType($type)->count();
            $exists += Friend::whereToUid($from_uid)->whereFromUid($to_uid)->whereType($type)->count();
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
        $requestInfo = Friend::where([['id',$id],['type',$type],['status',0]])
            ->where(function($query) use ($uid){
                $query->where('to_uid',$uid)->orWhere('from_uid',$uid);
            })
            ->exists();
        if(!$requestInfo)return apiError(1,'请求不存在');
    
        
        if($request == 'accept'){
            Friend::whereId($id)->update(['status'=>1]);
            //为用户增加体力
            $strength = 5;
            UserRepo::increUserStrength($uid,$strength);
            return apiSuccess('您已成功'.$type_message);
        }elseif($request == 'reject'){
            Friend::whereId($id)->update(['status'=>-1]);
            return apiSuccess('您已拒绝'.$type_message);
        }
    }
    
    public static function getMineFriendUid($uid)
    {
        return self::getList($uid,1,1,true);
    }

    public static function getMineFriendList($uid,$page,$limit,$key)
    {
        //单独做分页也是够拼的
        $reqs1 = Friend::whereToUid($uid)->whereStatus(1)->type(1)->pluck('from_uid');
        $reqs2 = Friend::whereFromUid($uid)->whereStatus(1)->type(1)->pluck('to_uid');
        $final_arr = $reqs1->union($reqs2)->toArray();
        $reqs = $reqs1->union($reqs2)->forPage($page,$limit);
        $list=[
            'total'=>count($final_arr),
            'current_page'=>$page,
            'last_page'=>count($final_arr)<=$limit?1:(int)(count($final_arr)/$limit + 1),
            'data'=>[],
        ];
        foreach ($reqs as $v) {
            $have = UserRepo::getUserSimpleInfo($v,function($query) use ($key){
                $query->where('nickname','like','%'.$key.'%');
            });
            if($have){
                $list['data'][]=$have;
            }
        }
        if($key){
            $allLikeUser_count = User::simple()->whereStatus(1)->whereNotIn('id',array_pluck($list['data'],'uid'))->where('nickname','like','%'.$key.'%');
            $allLikeUser=$allLikeUser_count->forPage($page,$limit)->get();

            $list=[
                'total'=>count($allLikeUser_count),
                'current_page'=>$page,
                'last_page'=>count($allLikeUser_count)<=$limit?1:(int)(count($allLikeUser_count)/$limit + 1),
                'data'=>[],
            ];
            $list['data'] = $allLikeUser;
        }
        $list['total']=count($list['data']);
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
        $reqs = Friend::whereToUid($uid)->whereStatus($status)->type($type)->pluck('from_uid','id');
        if($reqs->isEmpty())return [];
        if($justUid)return $reqs;
        $i=0;
        foreach ($reqs as $id=>$user_id) {
            $list[$i] = UserRepo::getUserSimpleInfo($user_id);
            $list[$i]['id']=$id;
            $i++;
        }
        return $list;
    }

}