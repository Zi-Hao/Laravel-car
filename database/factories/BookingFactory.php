<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {


    return [
        'subject'       => $faker->randomElement(['取得驾照','理论学习阶段','科目一', '科目二', '科目三', '科目四']),
        'booking_time' => $date = $faker->date("Y-m-d", 'now'),
        'coach'           => $faker->name,
        'complete'  => $faker->randomElement(['完成','未完成']),
    ];
});

