<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/15
 * Time: 15:37
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repository\OrderRepo;
use App\Services\Pay\AlipayService;
use App\Services\Pay\PayService;

class PayController extends Controller
{
    
    public function initPay($item_id)
    {
        //检查是否有未支付
        $params = Order::whereUidAndItemId($this->uid,$item_id)->where('status',0)->first();
        if(!$params){
            //生成订单
            $params = ['uid'         => $this->uid,
                       'item_id'     => $item_id,
                       'order_id'    => generateOrderId(),
                       'order_name'  => 'eugene alipay test',
                       'order_desc'  => 'test wap pay',
                       'order_price' => '0.01'
            ];
            OrderRepo::insertOrderInfo($params);
        }
        
        //发起订单
        $payService = new PayService(new AlipayService());
        $url = $payService->createWebPay($params);
        //跳转支付界面
        return redirect($url);
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