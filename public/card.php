<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 20:08
 */

session_start();

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/models/Card.php';

$cardID = $_GET['id'];

$card = Card::getCardFromID($cardID);

$view = new Template();

$view->title = $card["cardname"];
$view->card  = Card::prepareCardFromCardArray($card);

$view->content = $view->render(__DIR__ . '/../views/card.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');