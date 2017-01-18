<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiBasicTest extends TestCase
{
    
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
            'data'=>[['uid','nickname','avatar','star']]
        ]);
        $this->base('/api/rank/star',[
            'friends'=>1,
        ],[
            'data'=>[['uid','nickname','avatar','star']]
        ]);
    }
    
    public function testRankGold()
    {
        $this->base('/api/rank/gold',[
        
        ],[
            'data'=>[['uid','nickname','avatar','gold']]
        ]);
        $this->base('/api/rank/gold',[
            'friends'=>1,
        ],[
            'data'=>[['uid','nickname','avatar','gold']]
        ]);
    }
    
    
    
    
    
}
