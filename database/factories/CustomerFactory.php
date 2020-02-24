<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {

    $name = $faker->firstName() . ' ' . $faker->lastName();

    return [
        'name' => $name,
        'poc_name' => $name,
        'poc_email' => $faker->safeEmail(),
        'phone1' => $faker->phoneNumber(),
        'phone2' => $faker->phoneNumber(),
        'address1' => $faker->buildingNumber() . ' ' . $faker->streetName(),
        'address2' => $faker->secondaryAddress(),
        'city' => $faker->city(),
        'state' => $faker->stateAbbr(),
        'zip' => $faker->postCode(),
        'notes' => $faker->sentence()
    ];
});
