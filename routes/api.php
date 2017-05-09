<?php

Route::any('startad','IndexController@startAd') ;

Route::group(['prefix'=>'user'],function(){
    Route::post('reg','UserController@reg') ;
    Route::post('info','UserController@info') ;
    Route::post('login','UserController@login') ;
    Route::post('thirdLogin','UserController@thirdLogin') ;
    Route::post('uploadAvatar','UserController@uploadAvatar');
    //TODO::deleteme when developed
    Route::post('addStrength',function(\Illuminate\Http\Request $request){
        App\Repository\UserRepo::increUserStrength($request->input('uid'),$request->input('strength',100));
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
    Route::any('goldList','LevelController@goldList');
    
    Route::any('starDetail','LevelController@starDetail')->middleware('need:star_id');
    Route::any('starDetail/judge','LevelController@starDetailJudge')->middleware('need:star_id');
    Route::any('goldDetail','LevelController@goldDetail')->middleware('need:gold_id');
    Route::any('goldDetail/judge','LevelController@goldDetailJudge')->middleware('need:gold_id');
    
    
    Route::any('mineWrong','LevelController@mineWrong');
    
    Route::group(['prefix'=>'submit'],function(){
        Route::any('star','LevelController@starSubmit')->middleware('need:star_id');
        Route::any('gold','LevelController@goldSubmit')->middleware('need:gold_id');
    });
    
    Route::any('questionDetail',function(\Illuminate\Http\Request $request){
        $info = App\Models\Question::find($request->input('id'));
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

Route::group(['prefix'=>'alipay'],function(){
    Route::any('buy/{gold}','PayController@initAlipay')->middleware('need:uid');
});
Route::group(['prefix'=>'wechatpay'],function(){
    Route::any('buy/{gold}','PayController@initWechatpay')->middleware('need:uid');
});
