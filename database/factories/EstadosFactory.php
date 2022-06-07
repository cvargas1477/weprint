<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Estados;
use Faker\Generator as Faker;

$factory->define(Estados::class, function (Faker $faker) {
    return [
        'estado' => $faker->name,
    ];
});
