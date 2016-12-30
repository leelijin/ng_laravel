<?php

use App\Level;
use App\Question;
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
        factory(Level::class,5)->create()->each(function($level){
            $level->questions()->save(factory(Question::class)->make());
        });
    }
}
