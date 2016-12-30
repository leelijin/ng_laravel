<?php

use App\Services\Func;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiBasicTest extends TestCase
{
    use DatabaseTransactions;
    
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
    
    public function testNotice()
    {
        $this->base('/api/index/notice',[
            
        ],[
            'announce'=>[
                'title'
            ],
            'friend_requests','friend_strength'
        ]);
    }
    
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
    
    public function testItemsStore()
    {
        $this->base('/api/items/store',[
            
        ],[
            ['id','title','need_gold','already_have']
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
