<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/1/20
 * Time: 10:47
 */

namespace App\Http\Controllers\Web;

use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\Notify;
use Overtrue\Wechat\Payment\UnifiedOrder;

class WechatPayController
{
    public function createPay()
    {
        //$config = config('wechat');
        //$business = new Business(
        //    $config['app_id'],
        //    $config['secret'],
        //    $config['mechant_id'],
        //    $config['mechant_key']
        //);
        //$order = new Payment\Order();
        //$order->body = 'test body';
        //$order->out_trade_no = md5(uniqid('',true).microtime());
        //$order->total_fee = '1'; // 单位为 “分”, 字符串类型
        //$order->openid = '123';
        //$order->notify_url = $config['notify_url'];
        //
        //$unifiedOrder = new UnifiedOrder($business, $order);
        //
        //$payment = new Payment($unifiedOrder);
    
        $payment=['abc'=>123];
        return view('pay.wechat',['payment'=>$payment]);
    }
    
    public function webNotice()
    {
        $notify = new Notify(
            APP_ID,
            APP_KEY,
            MCH_ID,
            MCH_KEY
        );
    
        $transaction = $notify->verify();
    
        if (!$transaction) {
            $notify->reply('FAIL', 'verify transaction error');
        }
    
        echo $notify->reply();
    }
}