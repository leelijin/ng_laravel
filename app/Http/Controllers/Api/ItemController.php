<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\ItemUser;

class ItemController extends Controller
{
    public function store()
    {
        $items = Item::all();
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
    
    
}
