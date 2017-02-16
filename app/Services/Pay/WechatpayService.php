<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/16
 * Time: 10:30
 */

namespace App\Services\Pay;


use Payment\Config;

class WechatpayService implements PayInterface
{
    
    public function payType()
    {
        return Config::WEIXIN;
    }
    
    public function getConfig()
    {
        return config('pay.wechat');
    }
    
    public function getPayClassify()
    {
        return Config::WX_CHANNEL_APP;
    }
}