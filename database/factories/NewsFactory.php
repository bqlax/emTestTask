<?php

use Faker\Generator as Faker;

$factory->define(\App\News::class, function (Faker $faker) {
    $title = $faker->sentence(rand(2, 5), true);
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    $user = rand(1,3);
    $data = [
        'title' => $title,
        'slug' => str_slug($title, '-'),
        'text' => $faker->sentence(rand(30, 60), true),
        'text_short' => $faker->sentence(rand(3, 10), true),
        'likes' => 0,
        'created_by' => $user,
        'modified_by' => $user,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];

    return $data;
});
