<?php


declare(strict_types=1);

use Arcanesoft\Foundation\Auth\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/* -----------------------------------------------------------------
 |  Model Factories
 | -----------------------------------------------------------------
 */

/** @var  \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'uuid'           => Str::uuid(),
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => 'password',
        'remember_token' => Str::random(10),
    ];
});
