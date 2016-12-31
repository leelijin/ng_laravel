<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LevelTest extends TestCase
{
    
    public function testStarlist()
    {
        $this->base('/api/level/starList',[
        
        ],[
            'current_level',
            'star_level_info'=>[
                ['id','question_number'],
            ],
        ]);
    }
    
    public function testGoldlist()
    {
        $this->base('/api/level/goldList',[
        
        ],[
            'current_level',
            'star_level_info'=>[
                ['id','question_number','reward'],
            ],
        ]);
    }
    
    public function testStarDetail()
    {
        $this->base('/api/level/starDetail',[
            'star_id'=>1,
        ],[
            ['id','question','content','image1','image2','answer_options','right_answer'],
        ]);
    }
    
    public function testGoldDetail()
    {
        $this->base('/api/level/goldDetail',[
            'gold_id'=>1,
        ],[
            ['id','question','content','image1','image2','answer_options','right_answer'],
        ]);
    }
    
    public function testLevelSubmit()
    {
        $this->base('/api/level/submit',[
            'star_id'=>1,
            //'gold_id'=>1,
        ],[
        
        ]);
    }
}
