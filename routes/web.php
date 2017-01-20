<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/download',function(){
   return 'ng download page.Developing...';
});

Route::group(['prefix'=>'pay','namespace'=>'Web'],function(){
    Route::group(['prefix'=>'alipay'],function(){
        Route::get('init','AliPayController@createPay');
        Route::get('webNotice','AliPayController@webNotice');
        Route::get('webReturn','AliPayController@webReturn');
    });
    Route::group(['prefix'=>'wechatPay'],function(){
        Route::get('init','WechatPayController@createPay');
        Route::get('webNotice','WechatPayController@webNotice');
    });
});


Route::get('/test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});