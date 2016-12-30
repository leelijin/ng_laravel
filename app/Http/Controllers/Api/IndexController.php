<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/28
 * Time: 11:13
 */

namespace App\Http\Controllers\Api;

use App\Services\Api;
use App\StartAd;

class IndexController
{
    public function index()
    {
        
    }
    
    public function startAd()
    {
        $info = StartAd::first();
        return Api::apiSuccess($info);
    }
    
}