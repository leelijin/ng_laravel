<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/29
 * Time: 15:55
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Service\Api;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        if(!$request->has('uid'))return Api::apiError(10,'需要登录');
        if(!$request->hasFile('avatar'))return Api::apiError(1,'无上传文件');
        $file_name = $request->file('avatar')->store('avatars');
        $avatar = config('app.url').'/storage/app/'.$file_name;
        return Api::apiSuccess([
            'uid'    => $this->uid,
            'avatar' => $avatar,
        ]);
    }
}