<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\ItemUser;

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
        return apiError(1,'暂未开通');
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
