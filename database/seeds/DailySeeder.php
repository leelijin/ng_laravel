<?php

use App\Models\StatDaily;
use Illuminate\Database\Seeder;

class DailySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(StatDaily::class,1)->create();
    }
}
