<?php

use App\Models\User;

Route::get('/',function(){
   return redirect()->to('/public/download');
});
Route::get('home',function(){
    return redirect()->to('/public/download');
});

Route::get('timestamp',function(){
    return time();
});
Route::get('download', function () {
    return view('web.download');
});
Route::get('share_self/{uid?}', function ($uid=0) {
    $userInfo = User::find($uid);
    if(!$userInfo)return redirect()->to('/public/download');
    $info=[
        'uid'=>$uid,
        'nickname'=>$userInfo->nickname,
        'avatar'=>$userInfo->avatar,
        'current_level'=>$userInfo->current_star_level
    ];
    return view('web.share',compact('info'));
});

Route::post('wechatpay/webNotice','Api\PayController@wxNotice');
Route::post('alipay/webNotice','Api\PayController@aliNotice');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('importExcelJob/{file}',function($file){
    $fileInfo = App\Models\File::find($file);
    
    $excelPath = 'master/'.$fileInfo->savepath.$fileInfo->savename;
    
    $excelList =  Maatwebsite\Excel\Facades\Excel::load($excelPath)->getSheet(0)->toArray();
    $rawList = collect($excelList)->map(function($item){
        return array_slice($item,0,14);
    });
    $rawList->shift();
    $rawList->each(function($item){
        if($item[0] && $item[8]>0){
            $list=[
                'level_id'=>(int)$item[10],
                'question'=>$item[0],
                'content'=>$item[1]?:'',
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


