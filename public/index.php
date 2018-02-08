<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 10:51
 */

session_start();

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/models/Card.php';

$view = new Template();

$cards = Card::getRandomCards(4);

for ($i = 0; $i < sizeof($cards); $i++)
{
    $cards[$i] = Card::prepareCardFromCardArray($cards[$i]);
}

$view->title = "Home";
$view->cards = $cards;

$view->content = $view->render(__DIR__ . '/../views/home.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');