<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 07/02/2018
 * Time: 12:49
 */

require_once __DIR__ . '/../src/models/Advert.php';

$intervals = array(
    "P14D", "P13D", "P12D", "P11D", "P10D", "P9D", "P8D", "P7D", "P6D", "P5D", "P4D", "P3D", "P2D", "P1D", "PT12H", "PT6H", "PT3H", "PT1H", "PT30M"
);

foreach ($intervals as $interval)
{
    $date = new DateTime(null, new DateTimeZone('Europe/London'));

    $dateSet = $date->add(new DateInterval($interval));

    for ($i = 0; $i < 500; $i++) {
        Advert::addAdvert(rand(1,25),rand(1,3000),rand(1,5),(float)rand(0,9) . rand(0,9) . "." . rand(0,9) . rand(0,9),$date->format('Y-m-d H:i:s'),"placeholder.png");
    }
}