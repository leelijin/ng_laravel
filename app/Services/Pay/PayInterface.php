<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/16
 * Time: 10:33
 */

namespace App\Services\Pay;


interface PayInterface
{
    public function payType();
    
    public function getConfig();
    
    public function getPayClassify();
}