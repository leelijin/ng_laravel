<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\Func;

class UserTest extends TestCase
{
    
    public function testLogin()
    {
        $this->base('/api/user/login',['mobile'=>'18782967230','password'=>'123456'],[
            'userInfo'=>[
                'uid','nickname','mobile','avatar','rank','gold','star','strength'
            ],
        ]);
    }
    
    public function testReg()
    {
        $this->base('/api/user/reg',[
            'mobile'=>'1878296'.mt_rand(1000,9999),'password'=>'123456','nickname'=>str_random(5),
        ],[
            'userInfo'=>[
                'uid','nickname','mobile','avatar','rank','gold','star','strength'
            ],
        ]);
    }
    
    public function testThirdLog()
    {
        $random_str = str_random(20);
        $random_nickname = str_random(5);
        $this->base('/api/user/thirdLogin',[
            'uuid'=>$random_str,'avatar'=>Func::default_avatar(),'nickname'=>$random_nickname,
        ],[
            'userInfo'=>[
                'uid','nickname','mobile','avatar','rank','gold','star','strength'
            ],
        ]);
        $this->base('/api/user/thirdLogin',[
            'uuid'=>$random_str,'avatar'=>Func::default_avatar(),'nickname'=>$random_nickname,
        ],[
            'userInfo'=>[
                'uid','nickname','mobile','avatar','rank','gold','star','strength'
            ],
        ]);
    }
}
