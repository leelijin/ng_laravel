<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/1/20
 * Time: 10:12
 */

namespace App\Http\Controllers\Web;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class AliPayController
{
    public function createPay()
    {
        // 创建支付单。
        $alipay = app('alipay.web');
        $alipay->setOutTradeNo('order_id');
        $alipay->setTotalFee('order_price');
        $alipay->setSubject('goods_name');
        $alipay->setBody('goods_description');
    
        $alipay->setQrPayMode('4'); //该设置为可选，添加该参数设置，支持二维码支付。
    
        // 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());
    }
    
    public function webNotice()
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay notify post data verification fail.', [
                'data' => Request::instance()->getContent()
            ]);
            return 'fail';
        }
    
        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }
    
        return 'success';
    }
    
    /**
     * 同步通知
     */
    public function webReturn()
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay return query data verification fail.', [
                'data' => Request::getQueryString()
            ]);
            return 'fail';
        }
        
        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify get data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }
        
        return 'success';
    }
}