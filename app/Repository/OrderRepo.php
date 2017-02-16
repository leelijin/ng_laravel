<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/15
 * Time: 15:38
 */

namespace App\Repository;


use App\Models\Order;

class OrderRepo
{
    public static function insertOrderInfo($params)
    {
        return Order::create($params);
    }
    
}