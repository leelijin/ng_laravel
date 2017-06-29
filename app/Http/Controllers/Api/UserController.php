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
use App\Models\User;
use App\Services\Api;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function uploadAvatar()
    {
        if(!$this->request->hasFile('avatar'))return Api::apiError(1,'无上传文件');
        $file_name = $this->request->file('avatar')->store('avatars');
        if($file_name){
            $avatar = config('app.url').'/storage/app/'.$file_name;
            return apiSuccess(['avatar' => $avatar],'头像上传成功');
        }
        return apiError(1,'上传错误');
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
            $this->params['password']=Hash::make($this->params['password']);
            $re = User::create($this->params);
            if($re){
                $userInfo = User::base()->find($re['id']);
                return apiSuccess(['userInfo'=>$userInfo]);
            }
        }else{
            return apiError(1,$valid->errors()->first());
        }
    }
    
    public function login()
    {
        $userSimpleInfo = User::where('mobile',$this->request['mobile'])->select('id','password')->first();
        if($userSimpleInfo){
            if(Hash::check($this->request['password'],$userSimpleInfo->password)){
                $userInfo = User::base()->find($userSimpleInfo->id);
                return apiSuccess(['userInfo'=>$userInfo]);
            }else{
                return apiError(1,'密码错误');
            }
        }else{
            return apiError(1,'用户不存在');
        }
    }
    
    public function info()
    {
        $userInfo = User::base()->find($this->uid);
        $singleGoldPrice = 0.1;
        return apiSuccess(compact('userInfo','singleGoldPrice'));
    }
    
    public function thirdLogin()
    {
        $valid = Validator::make($this->params,[
            'uuid'=>'required',
            'nickname'=>'required',
            'login_type'=>'required|in:wx,qq'
        ],[
            'uiid.required'=>'uuid必须',
            'nickname.required'=>'需要填写昵称',
            'login_type.in=>login_type必须传wx或qq',
        ]);
        if($valid->passes()){
            $userInfo = User::where('uuid',$this->request['uuid'])->base()->first();
            if(!$userInfo){
                $this->params['token']=substr($this->params['uuid'],0,20);
                $this->params['mobile']=substr($this->params['uuid'],0,11);
                $this->params['password']=Hash::make($this->params['uuid']);
                $re = User::create($this->params);
                if($re) $userInfo = User::base()->where('uuid',$this->request['uuid'])->first();
            }
            return apiSuccess(['userInfo'=>$userInfo]);
        }else{
            return apiError(1,$valid->errors()->first());
        }
    }
}