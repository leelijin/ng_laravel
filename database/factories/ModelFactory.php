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

$factory->define(App\User::class, function (Faker\Generator $faker) {
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
$factory->define(App\Level::class, function (Faker\Generator $faker) {
    return [
        'need_strength' =>  $faker->randomNumber() ,
        'question_number' =>  100 ,
        'time_limit' =>  $faker->randomNumber() ,
        'reward' =>  $faker->randomNumber() ,
        'challenge_times' =>  $faker->randomNumber() ,
        'level_type' =>  $faker->numberBetween(1,2) ,
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
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



