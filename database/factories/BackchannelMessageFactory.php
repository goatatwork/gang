<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BackchannelMessage;
use Faker\Generator as Faker;

$factory->define(BackchannelMessage::class, function (Faker $faker) {
    return [
        'message' => $faker->sentence(),
        'active' => true
    ];
});
