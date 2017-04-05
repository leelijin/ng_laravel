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
use App\Services\Pay\WechatpayService;

class PayController extends Controller
{
    
    public function initAlipay($gold)
    {
        return $this->commonPay($gold,2,new AlipayService());
    }
    
    public function initWechatpay($gold)
    {
        return $this->commonPay($gold,1,new WechatpayService());
    }
    
    private function commonPay($gold,$pay_type,$service)
    {
        //检查是否有未支付
        $params = Order::whereUid($this->uid)->where('status',0)->first();
        if(!$params){
            //生成订单
            $params = ['uid'         => $this->uid,
                       'gold'     => $gold,
                       'order_id'    => generateOrderId(),
                       'pay_type' => $pay_type,
                       'order_name'  => '金币购买',
                       'order_desc'  => "金币购买(数量：$gold,价格：￥0.01)",
                       'order_price' => '0.01'
            ];
            OrderRepo::insertOrderInfo($params);
        }
        $orderInfo=$params;
        //发起订单
        $payService = new PayService($service);
        $url = $payService->createPay($params);
        //跳转支付界面
        return apiSuccess(compact('url','orderInfo'));
    }
    
    public function aliNotice()
    {
        $payService = new PayService(new AlipayService());
        $re = $payService->notice();
        return $re;
    }
    
    public function wxNotice()
    {
        $payService = new PayService(new WechatpayService());
        $re = $payService->notice();
        return $re;
    }
    
    public function refund($order_id)
    {
        $payService = new PayService(new AlipayService());
        $re = $payService->refund($order_id);
        return $re;
    }
    

    
    

}