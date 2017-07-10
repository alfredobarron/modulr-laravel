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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Task::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->paragraph,
        'done' => 1,
        'order' => 1,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];

});