<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Problem;
use Faker\Generator as Faker;

$factory->define(Problem::class, function (Faker $faker) {
	$cost = [50, 60, 70, 80, 90, 100, 150, 200, 250];
    return [
		'name' => implode($faker->words($faker->numberBetween(3, 7)), ' '),
		'cost' => $cost[$faker->numberBetween(0, 8)],
		'vehicle_id' => $faker->numberBetween(1, 5),
    ];
});
