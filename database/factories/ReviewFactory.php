<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
	$reviewer = ['user', 'mechanic'];
    return [
		'user_id' => App\User::all()->random()->id,
		'mechanic_id' => App\Mechanic::all()->random()->id,
		'star' => $faker->numberBetween(1, 5),
		'reviewer' => $reviewer[$faker->numberBetween(0, 1)],
    ];
});
