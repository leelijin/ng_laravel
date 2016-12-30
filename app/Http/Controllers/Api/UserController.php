<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/29
 * Time: 15:55
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Model\User;
use App\Http\Service\Api;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function uploadAvatar()
    {
        if(!$this->request->has('uid'))return Api::apiError(10,'需要登录');
        if(!$this->request->hasFile('avatar'))return Api::apiError(1,'无上传文件');
        $file_name = $this->request->file('avatar')->store('avatars');
        $avatar = config('app.url').'/storage/app/'.$file_name;
        return Api::apiSuccess([
            'uid'    => $this->uid,
            'avatar' => $avatar,
        ]);
    }
    
    public function reg()
    {
        $data['userInfo']=[
            'uid'=>'121',
            'mobile'=>'18782960000',
            'nickname'=>'皮皮熊',
            'avatar'=>'http://7xq7jw.com1.z0.glb.clouddn.com/n0S9qzkI.jpeg',
            'rank'=>'土豪',
            'gold'=>2000,
            'star'=>100,
            'strength'=>100,
        ];
        $data['token']='TsnKXtglprH8ybEOehJZLaDikB9d4qS1UWYQjGCo';
        return Api::apiSuccess($data);
        
        $valid = Validator::make($this->params,[
            'nickname'=>'required',
            'mobile'=>'required',
            'password'=>'required',
        ]);
        if($valid->passes()){
            return $re = User::create($this->params);
        }else{
            dd($valid->errors());
        }
    }
}