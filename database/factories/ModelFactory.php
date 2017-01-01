<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


use Illuminate\Support\Facades\DB;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'nickname' => $faker->userName,
        'mobile' => $faker->numberBetween(130,190).$faker->numberBetween(10000000,99999999),
        'password' => $password ?: $password = bcrypt('secret'),
        'avatar'=>$faker->imageUrl(80,80),
        'rank'=>$faker->randomNumber(2),
        'gold'=>$faker->randomNumber(2),
        'star'=>$faker->randomNumber(2),
        'strength'=>$faker->randomNumber(2),
        'current_star_level'=>$faker->randomNumber(2),
        'current_gold_level'=>$faker->randomNumber(2),
        'token' => str_random(20),
    ];
});
$factory->define(App\Models\Level::class, function (Faker\Generator $faker) {
    return [
        'need_strength' =>  $faker->numberBetween(5,10)*10 ,
        'question_number' =>  100 ,
        'time_limit' =>  $faker->numberBetween(2,5)*10 ,
        'reward' =>  $faker->numberBetween(1,10)*100 ,
        'level_type' =>  $faker->numberBetween(1,2) ,
    ];
});

$factory->define(App\Models\Question::class, function (Faker\Generator $faker) {
    return [
        'level_id' =>  function () {
             return factory(App\Level::class)->create()->id;
        } ,
        'level_type' =>  $faker->boolean ,
        'title' =>  $faker->sentence(5) ,
        'content' =>  $faker->paragraph(2) ,
        'image1' =>  $faker->imageUrl(100,100) ,
        'image2' =>  $faker->imageUrl(100,100) ,
        'answer_options' =>  json_encode($faker->shuffle(['ans1','ans2','ans3','ans4'])),
        'right_answer' =>  $faker->numberBetween(1,3) ,
    ];
});



$factory->define(App\Models\Friend::class, function (Faker\Generator $faker) {
    return [
        'from_uid' =>  function () {
            return DB::table('users')->inRandomOrder()->value('id');
        } ,
        'to_uid' =>  function () {
            return DB::table('users')->inRandomOrder()->value('id');
        } ,
        'type' =>  $faker->numberBetween(1,2) ,
        'status' =>  function(){
            return 0;
            $array = [-1,0,1];
            return $array[mt_rand(0,2)];
        } ,
    ];
});

$factory->define(App\Models\Log::class, function (Faker\Generator $faker) {
    return [
        'uid' =>  $faker->randomNumber() ,
        'method' =>  $faker->word ,
        'client' =>  $faker->word ,
        'device_id' =>  $faker->word ,
        'version' =>  $faker->word ,
        'url' =>  $faker->url ,
        'ip' =>  $faker->word ,
        'create_time' =>  $faker->randomNumber() ,
        'params' =>  $faker->text ,
        'code' =>  $faker->randomNumber() ,
    ];
});

$factory->define(App\Models\Notice::class, function (Faker\Generator $faker) {
    return [
        'title' =>  $faker->word ,
        'content' =>  $faker->word ,
        'link' =>  $faker->word ,
    ];
});

$factory->define(App\Models\StartAd::class, function (Faker\Generator $faker) {
    return [
        'title' =>  $faker->word ,
        'cover' =>  $faker->word ,
        'second' =>  $faker->randomNumber() ,
        'link' =>  $faker->word ,
    ];
});

