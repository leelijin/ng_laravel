<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/28
 * Time: 11:13
 */

namespace App\Http\Controllers\Api;

use App\Http\Model\StartAd;
use App\Http\Service\Api;
use Dotenv\Validator;

class IndexController
{
    public function index()
    {
        return 'api_index';
    }
    
    public function startAd()
    {
        $info = StartAd::first();
        return Api::apiSuccess($info);
    }
    
}