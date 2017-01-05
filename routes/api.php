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

Route::any('startad','IndexController@startAd') ;

Route::group(['prefix'=>'user'],function(){
    Route::post('reg','UserController@reg') ;
    
    Route::post('login','UserController@login') ;
    
    Route::post('thirdLogin','UserController@thirdLogin') ;
    
    Route::post('uploadAvatar','UserController@uploadAvatar');
});

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

Route::group(['prefix'=>'level','middleware'=>'need:uid'],function(){
    Route::any('starList','LevelController@starList');
    Route::any('starDetail','LevelController@starQuestions')->middleware('need:star_id');
    Route::any('goldList','LevelController@starList');
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

Route::group(['prefix'=>'items','middleware'=>'need:uid'],function(){
    Route::post('store','ItemController@store');
    Route::post('user','ItemController@user')->middleware('need:uid');
    Route::post('buy','ItemController@buy')->middleware('need:uid');
});

Route::group(['prefix'=>'rank'],function(){
    Route::any('star','LevelController@rankStar');
    Route::any('star/friends','LevelController@rankStarFriends')->middleware('need:uid');
    Route::any('gold','LevelController@rankGold');
    Route::any('gold/friends','LevelController@rankGoldFriends')->middleware('need:uid');
});
