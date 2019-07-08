<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
	$type = ['car', 'motorcycle', 'microbus', 'bus', 'bicycle'];
    return [
        'type' => $type[$faker->unique()->numberBetween(0, 4)],
    ];
});
