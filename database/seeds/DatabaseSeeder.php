<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LevelTableSeeder::class);
        //$this->call(QuestionTableSeeder::class);
        //$this->call(UserTableSeeder::class);
        //$this->call(FriendRequestsSeeder::class);
        
    }
}
