<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/16
 * Time: 10:30
 */

namespace App\Services\Pay;


use Payment\Config;

class AlipayService implements PayInterface
{
    
    public function payType()
    {
        return Config::ALI;
    }
    
    public function getConfig()
    {
        return config('pay.alipay');
    }
    
    public function getPayClassify()
    {
        return Config::ALI_CHANNEL_WAP;
    }
}