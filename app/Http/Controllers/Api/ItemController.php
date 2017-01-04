<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function store()
    {
        $items = Item::all();
        foreach ($items as &$item) {
            $item->already_have=0;
        }
        return apiSuccess($items);
    }
}
