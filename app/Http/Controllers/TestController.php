<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/1
 * Time: 11:39
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class TestController
{
    public function index()
    {
        //return 123;
        //return config('app.lijin.one');
        //return App::environment();
        return DB::select('select * from ng_users');
    }
}