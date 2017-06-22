<?php
use App\Services\Api;

if(!function_exists('apiSuccess')){
    function apiSuccess($data,$message='请求成功'){
        return Api::apiSuccess($data,$message);
    }
}

if(!function_exists('apiError')){
    function apiError($error_code=1,$message='请求错误'){
        return Api::apiError($error_code,$message);
    }
}

if(!function_exists('requireLogin')){
    function requireLogin(){
        return apiError(10,'需要登录');
    }
}

if(!function_exists('pictureTransfer')){
    function pictureTransfer($cover){
        if(!$cover)return '';
        if(is_numeric($cover)){
            return config('app.master_url').App\Models\Picture::getPath($cover);
        }else{
            return $cover;
        }
    }
}

if(!function_exists('generateOrderId')){
    function generateOrderId(){
        return date('Ymdhis', time()).substr(floor(microtime()*1000),0,1).rand(0,9);
    }
}