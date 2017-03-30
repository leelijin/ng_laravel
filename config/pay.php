<?php
return [
    'alipay'    => [
        // 老版本参数，当使用新版本时，不需要传入
        //'partner'   => '2088111209548313',// 请填写自己的支付宝账号信息
        //'md5_key'   => 'axtg81dsx7n41v4rwtaaxssymnqyb9l6',// 此密码无效，请填写自己对应设置的值
        //// 转款接口，必须配置以下两项
        ////'account'   => 'xxxxx@126.com',
        ////'account_name' => 'xxxxx',
        //'sign_type' => 'MD5',// 默认方式    目前支持:RSA   MD5`
        
        
        // 支付宝2.0 接口  如果使用支付宝 新版 接口，请设置该参数，并且必须为 1.0。否则将默认使用支付宝老版接口
        'ali_version'     => '1.0',
         //调用的接口版本，固定为：1.0
        'app_id'          => '2016073000127286',
         //支付宝分配给开发者的应用ID
        'use_sandbox'     => true,
        //  新版支付，支持沙箱调试
        'ali_public_key'  => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'pay' . DIRECTORY_SEPARATOR . 'alipay_public_key.pem',
        // 支付宝新版本，每个应用对应的公钥都不一样了
        
        // 新版与老版支付  共同参数，
        'rsa_private_key' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'pay' . DIRECTORY_SEPARATOR . 'rsa_private_key.pem',
        "notify_url"      => 'http://1609217uc2.iask.in/alipay/webNotice',
        "return_url"      => 'http://1609217uc2.iask.in/alipay/webReturn',
        // 我的博客地址
        "time_expire"     => '15',
        // 取值为分钟
    ],
    'wechatpay' => [
        'app_id'  => 'wx5e7403ff0a5fe647',
        // 公众账号ID
        'mch_id'  => '1446910202',
        // 商户id
        'md5_key' => '73AE75B7F3A42C4FDEE875584F5D0A9E',
        // md5 秘钥
        
        'notify_url'  => env('APP_URL').'/wechatpay/webNotice',
        'time_expire' => '14',
        
        // 涉及资金流动时 退款  转款，需要提供该文件
        'cert_path'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wx' . DIRECTORY_SEPARATOR . 'apiclient_cert.pem',
        'key_path'    => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wx' . DIRECTORY_SEPARATOR . 'apiclient_key.pem',
    ],
];