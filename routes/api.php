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
    Route::post('handle','FriendController@handle')->middleware('need:request','need:from_uid');
    Route::post('strengthHandle','FriendController@strengthHandle')->middleware('need:request','need:from_uid');
});

Route::group(['prefix'=>'index'],function(){
    Route::any('notice','IndexController@notice');
});

Route::group(['prefix'=>'level','middleware'=>'need:uid'],function(){
    Route::any('starList','LevelController@starList');
    Route::any('starDetail','LevelController@starQuestion')->middleware('need:star_id');
    Route::any('goldList','LevelController@goldList');
    Route::any('goldDetail','LevelController@goldQuestion');
    Route::any('mineWrong','LevelController@mineWrong');
    
    Route::group(['prefix'=>'submit'],function(){
        Route::any('star','LevelController@starSubmit')->middleware('need:star_id');
    
        Route::any('gold','LevelController@goldSubmit')->middleware('need:gold_id');
    });
    
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
