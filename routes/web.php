<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::post('wechatpay/webNotice','Api\PayController@wxNotice');
Route::post('alipay/webNotice','Api\PayController@aliNotice');

Route::get('/test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});

