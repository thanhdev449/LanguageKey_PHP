<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CreatorTable;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

$factory->define(CreatorTable::class, function (Faker $faker) {
    return [
        "full_name" => $faker->name,
        "user_name" => $faker->userName,
        "email" => $faker->safeEmail,
        "password" => Hash::make("123123123"),
        "birthday" => $faker->date(),
        "avatar" => null,
        "address" => $faker->address,
        "country" => $faker->country,
        "api_token" => null,
        "score" => 0,
        "words" => 0,
        "level" => 0,
        "subcriber" => 0,
        "follower" => 0,
        "role" => 0,
        "is_deleted" => 0,
    ];
});
