<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/download',function(){
   return 'ng download page.Developing...';
});
Route::post('wechatpay/webNotice','Api\PayController@wxNotice');
Route::post('alipay/webNotice','Api\PayController@aliNotice');

Route::get('/test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});