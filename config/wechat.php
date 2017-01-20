<?php
return [
    'use_alias'    => env('WECHAT_USE_ALIAS', false),
    'app_id'       => '', // 必填
    'secret'       => '', // 必填
    'token'        => '',  // 必填
    'notify_url'=>env('APP_URL').'/pay/wechatPay/webNotice',
    'mechant_id'=>'',
    'mechant_key'=>'',
    'encoding_key' => env('WECHAT_ENCODING_KEY', 'YourEncodingAESKey') // 加密模式需要，其它模式不需要
];