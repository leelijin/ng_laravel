<?php

use App\Models\Level;
use App\Models\Question;
use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Level::class,100)->create()->each(function($level){
            $level->questions()->save(factory(Question::class)->make());
        });
    }
}
