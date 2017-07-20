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
    $fileInfo = App\Models\File::find($file);
    
    $excelPath = 'master/'.$fileInfo->savepath.$fileInfo->savename;
    
    $excelList =  Maatwebsite\Excel\Facades\Excel::load($excelPath)->getSheet(0)->toArray();
    $rawList = collect($excelList)->map(function($item){
        return array_slice($item,0,11);
    });
    $rawList->shift();
    $rawList->each(function($item){
        if($item[0] && $item[8]>0){
            $list=[
                'level_id'=>(int)$item[10],
                'question'=>$item[0],
                'content'=>$item[1],
                'image1'=>(int)$item[2],
                'image2'=>(int)$item[3],
                'answer_options'=>[$item[4],$item[5],$item[6],$item[7]],
                'right_answer'=>(int)($item[8]-1),
                'time_limit'=>(int)$item[11]?:10,
                'status'=>$item[12]=='直接启用'?1:0,
            ];
            App\Models\Question::create($list);
        }
    });
});


