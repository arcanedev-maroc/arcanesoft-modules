<?php

use Arcanesoft\Foundation\Auth\Auth;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$userModel = Auth::model('user', Arcanesoft\Foundation\Auth\Models\User::class);

/** @var  Illuminate\Database\Eloquent\Factory  $factory */

$factory->define($userModel, function (Faker $faker) {
    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});

/* -----------------------------------------------------------------
 |  States
 | -----------------------------------------------------------------
 */

$factory->state($userModel, 'email-verified', [
    'email_verified_at' => now(),
]);

$factory->state($userModel, 'activated', [
    'activated_at' => now(),
]);

$factory->state($userModel, 'super-admin', [
    'is_admin' => true,
]);