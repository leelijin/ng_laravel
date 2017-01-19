<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/download',function(){
   return 'ng download page.Developing...';
});

Route::get('/test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});