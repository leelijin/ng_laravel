<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    
    public function testItemsStore()
    {
        $this->base('/api/items/store',[
            'uid'=>2,
        ],[
            ['id','title','need_gold','already_have']
        ]);
    }
}
