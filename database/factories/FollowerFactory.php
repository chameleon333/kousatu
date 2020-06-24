<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Follower;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Follower::class, function (Faker $faker) {
    return [
        'following_id' => function(){
            return factory(User::class)->create()->id;
        },
        'followed_id' => function(){
            return factory(User::class)->create()->id;
        },
    ];
});
