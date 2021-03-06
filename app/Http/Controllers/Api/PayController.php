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
use App\Models\User;
use App\Repository\OrderRepo;
use App\Repository\UserRepo;
use App\Services\Pay\AlipayService;
use App\Services\Pay\Notify;
use App\Services\Pay\PayService;
use App\Services\Pay\WechatpayService;

class PayController extends Controller
{
    
    public function initAlipay()
    {
        return $this->commonPay(2,new AlipayService());
    }
    
    public function initWechatpay()
    {
        return $this->commonPay(1,new WechatpayService());
    }
    
    public function applePay()
    {
        return $this->commonPay(3,null);
    }
    
    private function commonPay($pay_type,$service)
    {
        //检查是否已开通
        if(UserRepo::getUserWrongAuth($this->uid) == 1)return apiError(1,'已开通，无需再次支付');
        //检查是否有未支付
        $params = Order::whereUid($this->uid)->where('status',0)->first();
        if(!$params){
            $price = 18;
            //生成订单
            $params = [
                'uid' => $this->uid,
                'gold' => 0,
                'order_id' => generateOrderId(),
                'pay_type' => $pay_type,
                'order_name' => '购买错题库权限',
                'order_desc' => "购买错题库权限(数量:1,价格:￥$price)",
                'order_price' => $price,
            ];
            OrderRepo::insertOrderInfo($params);
        }
        $orderInfo=$params;
        //发起订单
        if($pay_type != 3){
            $payService = new PayService($service);
            $url = $payService->createPay($params);
        }else{
            $url = [];
        }
        
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
    
    public function applePayNotice()
    {
        $data['order_no']=$this->params['order_no'];
        $data['transaction_id']=$this->params['transaction_id'];
        $notify = new Notify();
        if($notify->notifyProcess($data)){
            return apiSuccess([],'处理成功');
        }
    }
    
    public function restore()
    {
        if($this->request->has('uid')){
            //恢复内购
            if(UserRepo::setUserWrongAuth($this->params['uid'])){
                return apiSuccess([],'已恢复内购');
            }
            return apiError(1,'恢复内购失败');
        }
        $have_payed = Order::where('transaction_id',$this->params['transaction_id'])->where('status',1)->exists();
        if($have_payed){
            return apiSuccess([],'已内购');
        }else{
            return apiError(1,'未找到此购买');
        }
        
    }
    

    
    

}