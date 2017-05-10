<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\ItemUser;
use App\Models\User;
use App\Repository\UserRepo;

class ItemController extends Controller
{
    public function store()
    {
        $items = Item::paginate($this->limit);
        foreach ($items as &$item) {
            $item->already_have=$this->uid>0?ItemUser::getUserItemCount($this->uid,$item->id):0;
        }
        return apiSuccess($items);
    }
    
    public function user()
    {
        return $this->store();
    }
    
    public function buy()
    {
        $amount=1;
        //检查道具是否可用
        $itemInfo = Item::whereStatus(1)->find($this->request->item_id);
        if(!$itemInfo)return apiError(1,'道具不可用');
        //检查用户金币是否足够
        $userGold = User::select('gold')->find($this->uid);
        $needGold = $itemInfo->need_gold * $amount;
        if($userGold->gold < $needGold)return apiError(1,'金币不够了，请先购买');
        //检查用户是否已拥有此道具
        $haveItem = ItemUser::whereItemId($this->request->item_id)->whereUserId($this->uid)->value('amount');
        if($haveItem >0){
            //如果已拥有直接增加数量
            ItemUser::whereItemId($this->params['item_id'])->whereUserId($this->uid)->increment('amount');
            //扣减用户金币
            User::whereId($this->uid)->decrement('gold',$needGold);
        }else{
            //否则新增数据
            ItemUser::create(['item_id'=>$this->request->item_id,'user_id'=>$this->uid]);
        }
        return apiSuccess('成功购买道具');
    }
    
    public function consume()
    {
        //查询用户是否还持有此道具
        $amount = ItemUser::whereItemId($this->params['item_id'])->whereUserId($this->uid)->value('amount');
        if($amount >0){
            ItemUser::whereItemId($this->params['item_id'])->whereUserId($this->uid)->decrement('amount');
            return apiSuccess('成功扣减道具');
        }else{
            return apiError(1,'您已无此道具可用');
        }
        
    }
    
    
}
