<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiBasicTest extends TestCase
{
    //use DatabaseMigrations;
    
    private function base($uri,$params=[],array $dataStructure,$method='POST')
    {
        return $this->json($method,$uri,$params)
            ->seeJson(['error_code'=>0])
            ->seeJsonStructure(['data'=>$dataStructure]);
    }
    
    public function testTimestamp()
    {
        $this->visit('/timestamp')->see(time());
    }
    
    public function testStartAd()
    {
        $this->base('/api/startad',[],[
            'title','cover','second','link'
        ]);
        
    }
    
    //public function testLogin()
    //{
    //    $this->base('/api/user/login',['mobile'=>'18782967230','password'=>'123456'],[
    //        'userInfo'=>[
    //            'uid','nickname','mobile','avatar','rank','gold','star','strength'
    //        ],
    //        'token',
    //    ]);
    //}
    
    public function testReg()
    {
        $this->base('/api/user/reg',[
            'mobile'=>'1878296'.mt_rand(1000,9999),'password'=>'123456','nickname'=>str_random(5),
            ],[
            'userInfo'=>[
                'uid','nickname','mobile','avatar','rank','gold','star','strength'
            ],
            'token',
        ]);
    }
    
    
}
