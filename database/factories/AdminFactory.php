<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => "Admin",
        'email' => "admin@mechanic.com",
        'password' => Hash::make('password'),
    ];
});
