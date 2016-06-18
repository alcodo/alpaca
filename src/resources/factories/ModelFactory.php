<?php

use Alpaca\User\Models\User;
use Alpaca\Page\Models\Category;
use Alpaca\Page\Models\Topic;
use Alpaca\Page\Models\Page;
use Alpaca\Menu\Models\Menu;
use Alpaca\Block\Models\Block;

/*
 * User
 */
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
        'password' => str_random(6),
    ];
});

/*
 * Page
 */
$factory->define(Topic::class, function ($faker) {
    return [
        'title' => $faker->unique()->firstNameFemale,
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

/*
 * Menu
 */
$factory->define(Menu::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
    ];
});

/*
 * Block
 */
$factory->define(Block::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'area' => 'left',
        'exception' => '',
        'range' => 0,
        'html' => $faker->sentence(),
        'active' => 1,
    ];
});