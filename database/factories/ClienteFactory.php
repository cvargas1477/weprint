<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'rut' => $faker->word,
        'nombres' => $faker->name,
        'apellidos' => $faker->name,
        'celular' => $faker->phoneNumber,
        'direccion' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'observacion' => $faker->name,
        'users_id' => $faker->name,

    ];
});
