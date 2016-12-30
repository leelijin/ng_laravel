<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/29
 * Time: 15:55
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use App\Http\Service\Api;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function uploadAvatar()
    {
        if(!$this->request->hasFile('avatar'))return Api::apiError(1,'无上传文件');
        $file_name = $this->request->file('avatar')->store('avatars');
        $avatar = config('app.url').'/storage/app/'.$file_name;
        $user = User::find($this->uid);
        if($user){
            $user->avatar=$avatar;
            $re = $user->update();
            if($re){
                return Api::apiSuccess([
                    'avatar' => $avatar,
                ],'头像保存成功');
            }
        }else{
            
        }
        return Api::apiError(1,'上传错误');
        
    }
    
    public function reg()
    {
        $valid = Validator::make($this->params,[
            'nickname'=>'required',
            'mobile'=>'required|unique:users',
            'password'=>'required',
        ],[
            'nickname.required'=>'需要填写昵称',
            'mobile.unique'=>'手机号码已注册',
            
        ]);
        if($valid->passes()){
            return $re = User::create($this->params);
        }else{
            return Api::apiError(1,$valid->errors()->first());
        }
    }
    
    public function login()
    {
        $userInfo = User::where('mobile',$this->request['mobile'])->get();
        if($userInfo){
            
        }else{
            
        }
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
    }
}