<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Mechanic;
use Faker\Generator as Faker;

$factory->define(Mechanic::class, function (Faker $faker) {
    $prefix = ['015', '016', '017', '018', '019'];
    return [
        'name' => $faker->firstNameMale . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $prefix[$faker->numberBetween(0, 4)] . $faker->unique()->randomNumber(8, true),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'latitude' => $faker->unique()->randomFloat(6, 23.732198, 23.757643),
		'longitude' => $faker->unique()->randomFloat(6, 90.363804, 90.422727),
    ];
});
