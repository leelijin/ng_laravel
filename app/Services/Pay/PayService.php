<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/15
 * Time: 15:51
 */

namespace App\Services\Pay;

use Payment\ChargeContext;
use Payment\NotifyContext;
use Payment\RefundContext;


class PayService
{
    private $payObj;
    
    public function __construct(PayInterface $payObj)
    {
        $this->payObj=$payObj;
    }
    
    public function createPay($orderInfo)
    {
        // 订单信息
        $payData = [
            "order_no"	=> $orderInfo['order_id'],
            "amount"	=> $orderInfo['order_price'],// 单位为元 ,最小为0.01
            "client_ip"	=> '127.0.0.1',
            "subject"	=> $orderInfo['order_name'],
            "body"	=> $orderInfo['order_desc'],
            "show_url"  => 'http://www.cdfer.com',// 支付宝手机网站支付接口 该参数必须上传 。其他接口忽略
            "extra_param"	=> '',
        ];
        $charge = new ChargeContext();
        $charge->initCharge($this->payObj->getPayClassify(), $this->payObj->getConfig());
        $ret = $charge->charge($payData);
        return $ret;
    }
    
    public function notice()
    {
        $notify = new NotifyContext();

        $callback = new Notify();

        $notify->initNotify($this->payObj->payType(), $this->payObj->getConfig());

        $ret = $notify->notify($callback);
        return $ret;
    }
    
    

}