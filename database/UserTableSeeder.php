<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 15:09
 */

require_once __DIR__ . '/../vendor/fzaninotto/faker/src/autoload.php';
require_once __DIR__ . '/../src/models/User.php';

$faker = Faker\Factory::create("en_GB");

User::createUser(
    'George',
    'Broadley',
    'george@broadley.co',
    "password",
    '1 Test Street',
    '',
    '',
    'Test City',
    'GB',
    'M5 4WT',
    '07441223535'
);

for ($i = 0; $i < 2999; $i++)
{
    User::createUser(
        $faker->firstName(),
        $faker->lastName,
        $faker->safeEmail,
        "password",
        $faker->streetAddress,
        '',
        '',
        $faker->city,
        $faker->countryCode,
        $faker->postcode,
        $faker->phoneNumber
    );
}