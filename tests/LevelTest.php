<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LevelTest extends TestCase
{
    
    public function testStarlist()
    {
        $this->base('/api/level/starList',[
            'uid'=>2,
        ],[
            'current_level',
            'star_level_info'=>[
                ['id','need_strength','question_number','time_limit'],
            ],
        ]);
    }
    
    public function testGoldlist()
    {
        $this->base('/api/level/goldList',[
            'uid'=>2,
        ],[
            'current_level',
            'gold_level_info'=>[
                ['id','need_strength','question_number','time_limit','reward','challenge_times'],
            ],
        ]);
    }
    
    public function testStarDetail()
    {
        $this->base('/api/level/starDetail',[
            'star_id'=>1,'uid'=>2,
        ],[
            ['id','question','content','image1','image2','answer_options','right_answer'],
        ]);
    }
    
    public function testGoldDetail()
    {
        $this->base('/api/level/goldDetail',[
            'gold_id'=>1,'uid'=>2,
        ],[
            ['id','question','content','image1','image2','answer_options','right_answer'],
        ]);
    }
    
    public function testLevelSubmit()
    {
        $this->base('/api/level/submit',[
            'star_id'=>1,'uid'=>2,
            //'gold_id'=>1,
        ],[
        
        ]);
    }
}
