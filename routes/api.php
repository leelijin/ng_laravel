<?php

Route::any('startad','IndexController@startAd') ;

Route::group(['prefix'=>'user'],function(){
    Route::post('reg','UserController@reg') ;
    Route::post('info','UserController@info') ;
    Route::post('login','UserController@login') ;
    Route::post('thirdLogin','UserController@thirdLogin') ;
    Route::post('uploadAvatar','UserController@uploadAvatar');
    //TODO::deleteme when developed
    Route::post('submitMood',function(\Illuminate\Http\Request $request){
        return App\Repository\UserRepo::submitMood($request->input('uid'),$request->input('mood')) ? apiSuccess('修改心情成功') : apiError(1,'修改失败');
    });
    Route::post('submitQuestion','LevelController@submitQuestion');
});

Route::group(['prefix'=>'friends','middleware'=>'need:uid'],function() {
    Route::post('mine','FriendController@mine');
    Route::post('add','FriendController@add')->middleware('need:to_uid');
    Route::post('strengthRequest','FriendController@strengthRequest')->middleware('need:to_uid');
    Route::post('handle','FriendController@handle')->middleware('need:request','need:id');
    Route::post('strengthHandle','FriendController@strengthHandle')->middleware('need:request','need:id');
    Route::post('info/{friend_uid}','FriendController@info');
    
});

Route::group(['prefix'=>'index'],function(){
    Route::any('notice','IndexController@notice');
});

Route::group(['prefix'=>'level','middleware'=>'need:uid'],function(){
    Route::any('starList','LevelController@starList');
    Route::any('goldList','LevelController@goldList');
    
    Route::any('starDetail','LevelController@starDetail');
    Route::any('starDetail/judge','LevelController@starDetailJudge')->middleware('need:star_id');
    Route::any('goldDetail','LevelController@goldDetail');
    Route::any('goldDetail/judge','LevelController@goldDetailJudge')->middleware('need:gold_id');
    
    
    Route::any('mineWrong','LevelController@mineWrong');
    
    Route::any('mineWrong/delete','LevelController@mineWrongDelete');
    
    Route::group(['prefix'=>'submit'],function(){
        Route::any('star','LevelController@starSubmit')->middleware('need:pass_ids');
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
    Route::post('buy','ItemController@buy')->middleware('need:uid','need:item_id');
    Route::post('consume','ItemController@consume')->middleware('need:item_id');
});

//Route::group(['prefix'=>'rank'],function(){
    Route::any('rank','LevelController@rank');
    Route::any('rank/friends','LevelController@rankFriends')->middleware('need:uid');
    //Route::any('gold','LevelController@rankGold');
    //Route::any('gold/friends','LevelController@rankGoldFriends')->middleware('need:uid');
//});

Route::group(['prefix'=>'alipay'],function(){
    Route::any('buy/wrong','PayController@initAlipay')->middleware('need:uid');
});
Route::group(['prefix'=>'wechatpay'],function(){
    Route::any('buy/wrong','PayController@initWechatpay')->middleware('need:uid');
});

Route::group(['prefix'=>'applepay'],function(){
    Route::any('buy/wrong','PayController@applePay')->middleware('need:uid');
    Route::any('notice','PayController@applePayNotice')->middleware('need:uid')->middleware('need:order_no')->middleware('need:transaction_id');
    Route::any('restore','PayController@restore')->middleware('need:transaction_id');
});

Route::any('share', function () {
    $config_name = 'SHARE_SETTINGS';
    $info = json_decode(\Illuminate\Support\Facades\DB::table('config')->whereName($config_name)->value('value'),true);
    $info['thumb']=pictureTransfer($info['thumb']);
    $info['link'] = $info['link']?:env('APP_URL').'/share_self';
    unset($info['content']);
    return apiSuccess($info);
});

Route::any('contact_us', function () {
    $config_name = 'CONTACT_US_WEB';
    $value= json_decode(\Illuminate\Support\Facades\DB::table('config')->whereName($config_name)->value('value'),true);
    $data['img1']=pictureTransfer($value['img1']);
    $data['img2']=pictureTransfer($value['img2']);
    $data['content']=$value['content'];
    return apiSuccess($data);
});