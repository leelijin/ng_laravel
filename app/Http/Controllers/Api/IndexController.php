<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/28
 * Time: 11:13
 */

namespace App\Http\Controllers\Api;

use Dotenv\Validator;
use Illuminate\Support\Facades\Crypt;

class IndexController
{
    public function index()
    {
        Validator::make();
        return 'api_index';
    }
}