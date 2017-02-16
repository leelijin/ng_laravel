<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/15
 * Time: 15:37
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repository\OrderRepo;
use App\Services\Pay\AlipayService;
use App\Services\Pay\PayService;

class PayController extends Controller
{
    
    public function initPay($gold)
    {
        //检查是否有未支付
        $params = Order::whereUid($this->uid)->where('status',0)->first();
        if(!$params){
            //生成订单
            $params = ['uid'         => $this->uid,
                       'gold'     => $gold,
                       'order_id'    => generateOrderId(),
                       'order_name'  => '金币购买',
                       'order_desc'  => "金币购买(数量：$gold,价格：￥0.01)",
                       'order_price' => '0.01'
            ];
            OrderRepo::insertOrderInfo($params);
        }
        $orderInfo=$params;
        //发起订单
        $payService = new PayService(new AlipayService());
        $url = $payService->createWebPay($params);
        //跳转支付界面
        return apiSuccess(compact('url','orderInfo'));
    }
    
    public function notice()
    {
        $payService = new PayService(new AlipayService());
        $re = $payService->notice();
        return $re;
    }
    
    public function payReturn()
    {
        return 'success';
    }
    
    public function refund($order_id)
    {
        $payService = new PayService(new AlipayService());
        $re = $payService->refund($order_id);
        return $re;
    }
    

    
    

}