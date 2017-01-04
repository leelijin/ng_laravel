<?php

use App\Services\Api;
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

Route::any('index','IndexController@Index');

Route::group(['prefix'=>'user'],function(){
    Route::post('reg','UserController@reg') ;
    
    Route::post('login','UserController@login') ;
    
    Route::post('thirdLogin','UserController@thirdLogin') ;
    
    Route::any('getUserItems',function(){
        
    }) ;
    Route::post('uploadAvatar','UserController@uploadAvatar');
});

Route::any('startad','IndexController@startAd') ;

Route::group(['prefix'=>'friends','middleware'=>'need:uid'],function() {
    Route::post('mine','FriendController@mine');
    Route::post('add','FriendController@add')->middleware('need:to_uid');
    Route::post('strengthRequest','FriendController@strengthRequest')->middleware('need:to_uid');
    Route::post('handle','FriendController@handle')->middleware('need:request','need:id');
    Route::post('strengthHandle','FriendController@strengthHandle')->middleware('need:request','need:id');
});

Route::group(['prefix'=>'index'],function(){
    Route::any('notice','IndexController@notice');
});

Route::group(['prefix'=>'level'],function(){
    Route::any('starList',function(){
        $data['current_level']=4;
        $data['star_level_info']=[
            ['id'=>1,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>2,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>3,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>4,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>5,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>6,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>7,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>8,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>9,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
            ['id'=>10,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200],
        ];
        return Api::apiSuccess($data);
    });
    Route::any('starDetail',function(){
        $data=[
            ['id'=>1,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>0],
            ['id'=>2,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>1],
            ['id'=>3,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>2],
            ['id'=>4,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>3],
            ['id'=>5,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>0],
        ];
        return Api::apiSuccess($data);
    });
    Route::any('goldList',function(){
        $data['current_level']=5;
        $data['gold_level_info']=[
            ['id'=>1,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>2],
            ['id'=>2,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>2],
            ['id'=>3,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>2],
            ['id'=>4,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>2],
            ['id'=>5,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>1],
            ['id'=>6,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>0],
            ['id'=>7,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>0],
            ['id'=>8,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>0],
            ['id'=>9,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>0],
            ['id'=>10,'need_strength'=>40,'question_number'=>100,'time_limit'=>1200,'reward'=>2000,'challenge_times'=>0],
        ];
        return Api::apiSuccess($data);
    });
    Route::any('goldDetail',function(){
        $data=[
            ['id'=>1,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>0],
            ['id'=>2,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>1],
            ['id'=>3,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>2],
            ['id'=>4,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>3],
            ['id'=>5,'question'=>'请在以下选择一个正确答案','content'=>'问题描述','image1'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','image2'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','answer_options'=>['选项A','选项B','选项C','选项D'],'right_answer'=>0],
        ];
        return Api::apiSuccess($data);
    });
    Route::any('wrong',function(){
        
    });
    Route::any('submit',function(){
        return Api::apiSuccess('恭喜过关');
    });
    
});

Route::group(['prefix'=>'items'],function(){
    Route::post('store','ItemController@store');
    Route::post('user','ItemController@user')->middleware('need:uid');
    Route::post('buy','ItemController@buy')->middleware('need:uid');
});

Route::group(['prefix'=>'rank'],function(){
    Route::any('star',function(){
        $data=[
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','star'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','star'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','star'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','star'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','star'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','star'=>10200],
        ];
        return Api::apiSuccess($data);
    });
    Route::any('gold',function(){
        $data=[
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','gold'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','gold'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','gold'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','gold'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','gold'=>10200],
            ['uid'=>1,'nickname'=>'nickname1','avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg','gold'=>10200],
        ];
        return Api::apiSuccess($data);
    });
});

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');