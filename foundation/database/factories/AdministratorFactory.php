<?php


declare(strict_types=1);

use Arcanesoft\Foundation\Auth\Models\Administrator;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/* -----------------------------------------------------------------
 |  Model Factories
 | -----------------------------------------------------------------
 */

/** @var  \Illuminate\Database\Eloquent\Factory  $factory */

$factory->define(Administrator::class, function (Faker $faker) {
    return [
        'uuid'           => Str::uuid(),
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => 'password',
        'remember_token' => Str::random(10),
    ];
});
