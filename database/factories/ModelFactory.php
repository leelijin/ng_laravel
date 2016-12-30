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

$factory->define(App\Http\Model\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'nickname' => $faker->name,
        'mobile' => $faker->unique()->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'avatar'=>$faker->imageUrl(80,80),
        'rank'=>$faker->randomDigit,
        'gold'=>$faker->randomDigit,
        'star'=>$faker->randomDigit,
        'strength'=>$faker->randomDigit,
        'current_star_level'=>$faker->randomDigit,
        'current_gold_level'=>$faker->randomDigit,
        'token' => str_random(20),
    ];
});
