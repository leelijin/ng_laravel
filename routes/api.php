<?php

use App\Models\Question;
use App\Repository\UserRepo;
use Illuminate\Http\Request;

Route::any('startad','IndexController@startAd') ;

Route::group(['prefix'=>'user'],function(){
    Route::post('reg','UserController@reg') ;
    Route::post('login','UserController@login') ;
    Route::post('thirdLogin','UserController@thirdLogin') ;
    Route::post('uploadAvatar','UserController@uploadAvatar');
    //TODO::deleteme when developed
    Route::post('addStrength',function(\Illuminate\Http\Request $request){
        UserRepo::increUserStrength($request->input('uid'),$request->input('strength',100));
    });
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
    Route::any('starDetail','LevelController@starQuestion')->middleware('need:star_id');
    Route::any('goldList','LevelController@goldList');
    Route::any('goldDetail','LevelController@goldQuestion')->middleware('need:gold_id');
    Route::any('mineWrong','LevelController@mineWrong');
    
    Route::group(['prefix'=>'submit'],function(){
        Route::any('star','LevelController@starSubmit')->middleware('need:star_id');
        Route::any('gold','LevelController@goldSubmit')->middleware('need:gold_id');
    });
    
    Route::any('questionDetail',function(Request $request){
        $info = Question::find($request->input('id'));
        return $info?apiSuccess($info):apiError(1,'不存在的题目');
    })->middleware('need:id');
});

Route::group(['prefix'=>'items','middleware'=>'need:uid'],function(){
    Route::post('store','ItemController@store');
    Route::post('user','ItemController@user')->middleware('need:uid');
    Route::post('buy','ItemController@buy')->middleware('need:uid');
    Route::post('consume','ItemController@consume')->middleware('need:item_id');
});

Route::group(['prefix'=>'rank'],function(){
    Route::any('star','LevelController@rankStar');
    Route::any('star/friends','LevelController@rankStarFriends')->middleware('need:uid');
    Route::any('gold','LevelController@rankGold');
    Route::any('gold/friends','LevelController@rankGoldFriends')->middleware('need:uid');
});
