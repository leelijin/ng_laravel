<?php

Route::get('/', function () {
    return redirect('master');
});
Route::get('timestamp',function(){
    return time();
});
Route::get('download', function () {
    return view('web.download');
});
Route::get('share_self', function () {
    $config_name = 'SHARE_SETTINGS';
    $info = json_decode(\Illuminate\Support\Facades\DB::table('config')->whereName($config_name)->value('value'),true);
    return view('web.share',['content'=>$info['content']]);
});

Route::post('wechatpay/webNotice','Api\PayController@wxNotice');
Route::post('alipay/webNotice','Api\PayController@aliNotice');

Route::get('importExcelJob/{file}',function($file){
    dispatch(new App\Jobs\ImportExcelJob(App\Models\File::find($file)));
});

