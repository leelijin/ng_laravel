<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/29
 * Time: 15:55
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\Func;
use App\User;
use App\Services\Api;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function uploadAvatar()
    {
        if(!$this->request->hasFile('avatar'))return Api::apiError(1,'无上传文件');
        $file_name = $this->request->file('avatar')->store('avatars');
        if($file_name){
            $avatar = config('app.url').'/storage/app/'.$file_name;
            return Api::apiSuccess(['avatar' => $avatar],'头像上传成功');
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
            $this->params['token']=str_random(20);
            $this->params['avatar'] = $this->request->has('avatar')?$this->params['avatar']:Func::default_avatar();
            $re = User::create($this->params);
            if($re){
                $userInfo = User::base()->find($re['id']);
                return Api::apiSuccess(compact('userInfo'));
            }
        }else{
            return Api::apiError(1,$valid->errors()->first());
        }
    }
    
    public function login()
    {
        $userInfo = User::where('mobile',$this->request['mobile'])
            ->where('password',$this->request['password'])->base()->get();
        if($userInfo){
            return Api::apiSuccess(compact('userInfo'));
        }else{
            return Api::apiError(1,'用户不存在或密码错误');
        }
    }
    
    public function thirdLogin()
    {
        $valid = Validator::make($this->params,[
            'uuid'=>'required',
            'nickname'=>'required',
        ],[
            'uiid.required'=>'uuid必须',
            'nickname.required'=>'需要填写昵称',
        ]);
        if($valid->passes()){
            $userInfo = User::where('uuid',$this->request['uuid'])
                ->base()->get();
            if($userInfo->isNotEmpty()){
                return Api::apiSuccess(compact('userInfo'));
            }else{
                $this->params['token']=substr($this->params['uuid'],0,20);
                $this->params['mobile']=substr($this->params['uuid'],0,11);
                $this->params['password']=str_random(20);
                $re = User::create($this->params);
                if($re){
                    $userInfo = User::base()->where('uuid',$this->request['uuid'])->get();
                    return Api::apiSuccess(compact('userInfo'));
                }
            }
        }else{
            return Api::apiError(1,$valid->errors()->first());
        }
    }
}