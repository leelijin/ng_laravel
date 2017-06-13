<?php

Route::get('/', function () {
    return redirect('admin');
});
Route::get('contact_us', function () {
    return 'contact_us_web_page';
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

