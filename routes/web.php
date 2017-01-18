<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});