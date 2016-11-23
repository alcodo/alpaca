<?php

use Alpaca\User\Models\User;
use Alpaca\Page\Models\Category;
use Alpaca\Page\Models\Topic;
use Alpaca\Page\Models\Page;
use Alpaca\Menu\Models\Menu;
use Alpaca\Menu\Models\Item;
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
        'email_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'admin', function ($faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'remember_token' => str_random(10),
        'admin' => true,
        'email_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'testuser', function ($faker) {
    static $password;

    return [
        'username' => 'testuser',
        'email' => 'testuser@testuser.com',
        'password' => $password ?: $password = bcrypt('testuser'),
        'remember_token' => str_random(10),
        'email_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'form', function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(6),
        'email_token' => str_random(10),
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
$factory->define(Item::class, function (Faker\Generator $faker) {
    return [
        'text' => $faker->name,
        'title' => $faker->firstNameMale,
        'href' => $faker->countryCode,
        'rel' => 'nofollow',
        'target' => '',
    ];
});

/*
 * Block
 */
$factory->define(Block::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'title' => $faker->name,
        'area' => 'left',
        'exception_rule' => Block::EXCEPTION_EXCLUDE,
        'exception' => '',
        'range' => 0,
        'html' => $faker->sentence(),
        'active' => 1,
        'mobile_view' => 1,
        'desktop_view' => 1,
        'desktop_view_force' => 0,
    ];
});
