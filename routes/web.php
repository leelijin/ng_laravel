<?php

Route::get('/', function () {
    return redirect('master');
});
Route::get('contact_us', function () {
    $config_name = 'CONTACT_US_WEB';
    $value= json_decode(\Illuminate\Support\Facades\DB::table('config')->whereName($config_name)->value('value'),true);
    $data['img']=$_SERVER['HTTP_HOST'].\Illuminate\Support\Facades\DB::table('picture')->whereId($value[0])->value('path');
    $data['content']=$value[1];
    return $data;
});
Route::get('share', function () {
    return view('web.download');
});

Route::post('wechatpay/webNotice','Api\PayController@wxNotice');
Route::post('alipay/webNotice','Api\PayController@aliNotice');

Route::post('test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});

