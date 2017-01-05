<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiBasicTest extends TestCase
{
    
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
    
    
    public function testNotice()
    {
        $this->base('/api/index/notice',[
            
        ],[
            'announce'=>['title'],
            'friend_requests'=>[],
            'friend_strength'=>[]
        ]);
    }
    
    
    public function testRankStar()
    {
        $this->base('/api/rank/star',[
            
        ],[
            ['uid','nickname','avatar','star']
        ]);
        $this->base('/api/rank/star',[
            'friends'=>1,
        ],[
            ['uid','nickname','avatar','star']
        ]);
    }
    
    public function testRankGold()
    {
        $this->base('/api/rank/gold',[
        
        ],[
            ['uid','nickname','avatar','gold']
        ]);
        $this->base('/api/rank/gold',[
            'friends'=>1,
        ],[
            ['uid','nickname','avatar','gold']
        ]);
    }
    
    
    
    
    
}
