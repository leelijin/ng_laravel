<?php

Route::get('/', function () {
    return redirect('master');
});
Route::get('contact_us', function () {
    $config_name = 'CONTACT_US_WEB';
    return \Illuminate\Support\Facades\DB::table('config')->whereName($config_name)->value('value');
});
Route::get('share', function () {
    return view('web.download');
});

Route::post('wechatpay/webNotice','Api\PayController@wxNotice');
Route::post('alipay/webNotice','Api\PayController@aliNotice');

Route::get('test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});

