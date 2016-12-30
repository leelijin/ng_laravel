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

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/seed',function(){
   return Artisan::call('db:seed');
});

Route::get('timestamp',function(){
    return time();
});