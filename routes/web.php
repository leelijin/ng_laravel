<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/download',function(){
   return 'ng download page.Developing...';
});

Route::group(['prefix'=>'alipay','namespace'=>'Web'],function(){
    Route::get('init/{item_id}','PayController@initPay')->middleware('need:uid');
    Route::post('webNotice','PayController@notice');
    Route::get('webReturn','PayController@payReturn');
    Route::get('refund/{order_id}','PayController@refund');
});
Route::group(['prefix'=>'wechatPay','namespace'=>'Web'],function(){
    Route::get('init/{item_id}','PayController@initPay')->middleware('need:uid');
    Route::post('webNotice','PayController@notice');
    Route::get('webReturn','PayController@payReturn');
    Route::get('refund/{order_id}','PayController@refund');
});


Route::get('/test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});