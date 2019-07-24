<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'content' => $faker->text($maxNbChars = 200),
        'image_url' => $faker->imageUrl($width = 1920, $height = 1080, 'fashion'),
        'user_id' => function() {
            return App\User::all()->random()->id;
        }
    ];
});
