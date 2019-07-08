<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
	$prefix = ['015', '016', '017', '018', '019'];
    return [
        'name' => $faker->firstNameMale . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $prefix[$faker->numberBetween(0, 4)] . $faker->unique()->randomNumber(8, true),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'vehicle_id' =>App\Vehicle::all()->random()->id,
        'vehicle' => $faker->regexify('[A-Z]{1}[a-z]{3,6} [A-Z]{1}[a-z]{3,6}'),
        'remember_token' => Str::random(10),
    ];
});
