<?php

use Alpaca\User\Models\User;
use Alpaca\Page\Models\Category;
use Alpaca\Page\Models\Page;
use Alpaca\Menu\Models\Menu;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'admin', function ($faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'remember_token' => str_random(10),
        'admin' => true,
    ];
});

$factory->defineAs(User::class, 'testuser', function ($faker) {
    return [
        'username' => 'testuser',
        'email' => 'testuser@testuser.com',
        'password' => 'testuser',
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'form', function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(6)
    ];
});

$factory->define(Category::class, function ($faker) {
    return [
        'title' => $faker->unique()->firstNameFemale,
        'body' => $faker->paragraph,
    ];
});
$factory->define(Page::class, function ($faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->text(),
    ];
});

$factory->define(Menu::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name
    ];
});