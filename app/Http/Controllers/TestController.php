<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/1
 * Time: 11:39
 */

namespace App\Http\Controllers;


use App\Models\Level;
use App\Models\LevelSetting;
use App\Models\User;

class TestController
{
    public function index()
    {
        return Level::find(1)->levelSettings()->get();
        
    }
}