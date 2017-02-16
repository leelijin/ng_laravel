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
    
    public function createWebPay($orderInfo)
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

        // 支付宝回调
        $notify->initNotify($this->payObj->payType(), $this->payObj->getConfig());

        $ret = $notify->notify($callback);
        return $ret;
    }
    
    public function refund($orderId,$transId,$refundFee,$reason='退款')
    {
        $reundData = [
            'refund_no' => $orderId,
            'refund_data'   => [
                ['transaction_id' => $transId, 'amount'   => $refundFee, 'refund_fee' => $refundFee, 'reason' => $reason],
            ],
        ];
        $refund = new RefundContext();
        $refund->initRefund($this->payObj->payType(), $this->payObj->getConfig());
        $ret = $refund->refund($reundData);
        return $ret;
    }
    

}