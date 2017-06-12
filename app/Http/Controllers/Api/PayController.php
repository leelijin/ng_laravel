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
use App\Services\Pay\Notify;
use App\Services\Pay\PayService;
use App\Services\Pay\WechatpayService;

class PayController extends Controller
{
    
    public function initAlipay($gold=1)
    {
        return $this->commonPay($gold,2,new AlipayService());
    }
    
    public function initWechatpay($gold=1)
    {
        return $this->commonPay($gold,1,new WechatpayService());
    }
    
    private function commonPay($gold,$pay_type,$service)
    {
        //检查是否有未支付
        $params = Order::whereUid($this->uid)->where('status',0)->first();
        if(!$params){
            //TODO::根据金币数量计算订单金额
            $price = 0.01;
            //生成订单
            $params = ['uid'         => $this->uid,
                       'gold'     => $gold,
                       'order_id'    => generateOrderId(),
                       'pay_type' => $pay_type,
                       'order_name'  => '金币购买',
                       'order_desc'  => "金币购买(数量:$gold,价格:￥$price)",
                       'order_price' => $price
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
    
    public function applePay($gold)
    {
        //检查是否有未支付
        $params = Order::whereUid($this->uid)->where('status',0)->first();
        if(!$params){
            //TODO::根据金币数量计算订单金额
            $price = 0.01;
            //生成订单
            $params = ['uid'         => $this->uid,
                       'gold'     => $gold,
                       'order_id'    => generateOrderId(),
                       'pay_type' => 3,
                       'order_name'  => '金币购买',
                       'order_desc'  => "金币购买(数量:$gold,价格:￥$price)",
                       'order_price' => $price
            ];
            OrderRepo::insertOrderInfo($params);
        }
        $orderInfo=$params;
        $url = [];
        //跳转支付界面
        return apiSuccess(compact('url','orderInfo'));
    }
    
    public function applePayNotice()
    {
        $data['order_no']=$this->params['order_no'];
        $data['transaction_id']=$this->params['transaction_id'];
        $notify = new Notify();
        if($notify->notifyProcess($data)){
            return apiSuccess([],'处理成功');
        }
    }
    

    
    

}