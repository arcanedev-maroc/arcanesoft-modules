<?php

declare(strict_types=1);

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/* -----------------------------------------------------------------
 |  Model Factories
 | -----------------------------------------------------------------
 */

/** @var  \Illuminate\Database\Eloquent\Factory  $factory */

$factory->define(User::class, function (Faker $faker) {
    return [
        'uuid'              => Str::uuid(),
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => 'password',
        'remember_token'    => Str::random(10),
    ];
});

$factory->state(User::class, 'unverified', [
    'email_verified_at' => null,
]);
