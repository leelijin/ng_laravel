<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

function apiReturn($data,$code,$message) {
    $result['error_code'] = $code?:0;
    $result['message']=$message?:'';
    $result['data']=$data?:[];
    return $result;
}

function apiSuccess($data,$message='请求成功') {
    if(is_string($data))$data=['message'=>$data];
    return apiReturn($data, 0, $message);
}

function apiError($error_code=1,$message='') {
    if(!is_numeric($error_code))exception('错误码应该是一个数字');
    return apiReturn([], $error_code,$message);
}

Route::any('apit','IndexController@Index');

Route::any('startad',function(){
    $data = [
        'title'=>'启动页广告',
        'cover'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg',
        'second'=>3,
        'link'=>'http://www.baidu.com',
    ];
    return apiSuccess($data);
}) ;

Route::group(['prefix'=>'index'],function(){
    
});

Route::group(['prefix'=>'level'],function(){
   
});

Route::group(['prefix'=>'user'],function(){
    Route::any('reg',function(){
        $data['userInfo']=[
            'uid'=>'121',
            'mobile'=>'18782960000',
            'nickname'=>'皮皮熊',
            'avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg',
            'rank'=>'土豪',
            'gold'=>2000,
            'star'=>100,
            'strength'=>100,
        ];
        $data['token']='TsnKXtglprH8ybEOehJZLaDikB9d4qS1UWYQjGCo';
        return apiSuccess($data);
    }) ;
    
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
