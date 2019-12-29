<?php

use Faker\Generator as Faker;

$factory->define(\App\Photo::class, function (Faker $faker) {
    $name = $faker->sentence(rand(1,3), true);
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    $user = rand(1,3);
    $photo = false;
    switch ($user) {
        case 1: {
            $photo = rand(1, 4);
            break;
        }
        case 2: {
            $photo = rand(5, 8);
            break;
        }
        case 3: {
            $photo = rand(9, 10);
            break;
        }
    }
    $data = [
        'name' => $name,
        'slug' => str_slug($name),
        'path' => 'photos/' . $user . '/' . $photo . '.jpg',
        'likes' => 0,
        'created_by' => $user,
        'modified_by' => $user,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];

    return $data;
});
