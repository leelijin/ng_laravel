<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class FriendTest extends TestCase
{
    
    public function testFriendAdd()
    {
        $random_uid = DB::table('users')->inRandomOrder()->value('id');
        $random_to_uid = DB::table('users')->inRandomOrder()->value('id');
        $this->base('/api/friends/add',[
            'uid'=>$random_uid,'to_uid'=>$random_to_uid
        ],[
        
        ]);
    }
    
    public function testFriendHandle()
    {
        $random = DB::table('friend_requests')->where('status',0)->inRandomOrder()->first();
        $handle = array_rand(['accept'=>1,'reject'=>2]);
        $this->base('/api/friends/handle',[
            'id'=>$random->id,'uid'=>$random->to_uid,'request'=>$handle
        ],[
        
        ]);
    }
    
    public function testFriendAddStrength()
    {
        $random_uid = DB::table('users')->inRandomOrder()->value('id');
        $random_to_uid = DB::table('users')->inRandomOrder()->value('id');
        $this->base('/api/friends/strengthRequest',[
            'uid'=>$random_uid,'to_uid'=>$random_to_uid
        ],[
        
        ]);
    }
    
    public function testFriendStrengthHandle()
    {
        $random = DB::table('friend_requests')->where('status',0)->inRandomOrder()->first();
        $handle = array_rand(['accept'=>1,'reject'=>2]);
        $this->base('/api/friends/strengthHandle',[
            'id'=>$random->id,'uid'=>$random->to_uid,'request'=>$handle
        ],[
        
        ]);
    }
}
