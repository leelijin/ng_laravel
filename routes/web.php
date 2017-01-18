<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/seed',function(){
    $time = 200;
    for($i=0;$i<$time;$i++) {
        Artisan::call('db:seed');
    }
});

Route::get('/test', 'TestController@index');

Route::get('timestamp',function(){
    return time();
});