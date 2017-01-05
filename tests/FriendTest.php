<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class FriendTest extends TestCase
{
    
    public function testFriendMine()
    {
        $this->base('/api/friends/mine',[
            'uid'=>$this->params['uid']
        ],[
            ['uid','nickname','avatar']
        ]);
    }
    
    public function testFriendAdd()
    {
        $this->base('/api/friends/add',[
            'uid'=>$this->params['uid'],'to_uid'=>$this->params['to_uid']
        ],[
        
        ]);
    }
    
    public function testFriendHandle()
    {
        $random = DB::table('friend_requests')->where('status',0)->whereType(1)->inRandomOrder()->first();
        $handle = array_rand(['accept'=>1,'reject'=>2]);
        $this->base('/api/friends/handle',[
            'id'=>$random->id,'uid'=>$random->to_uid,'request'=>$handle
        ],[
        
        ]);
    }
    
    public function testFriendAddStrength()
    {
        $this->base('/api/friends/strengthRequest',[
            'uid'=>$this->params['uid'],'to_uid'=>$this->params['to_uid']
        ],[
        
        ]);
    }
    
    public function testFriendStrengthHandle()
    {
        $random = DB::table('friend_requests')->where('status',0)->whereType(2)->inRandomOrder()->first();
        $handle = array_rand(['accept'=>1,'reject'=>2]);
        $this->base('/api/friends/strengthHandle',[
            'id'=>$random->id,'uid'=>$random->to_uid,'request'=>$handle
        ],[
        
        ]);
    }
}
