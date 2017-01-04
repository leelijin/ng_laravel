<?php

use App\Models\Friend;
use Illuminate\Database\Seeder;

class FriendRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Friend::class,100)->create();
    }
}
