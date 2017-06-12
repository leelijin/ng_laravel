<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/1
 * Time: 11:39
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Api\PayController;
use App\Models\Level;
use App\Models\LevelSetting;
use App\Models\Order;
use App\Models\Question;
use App\Models\User;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\DB;

class TestController
{
    public function index()
    {
        return DB::table('users')->take(5)->get();
    }
    
}