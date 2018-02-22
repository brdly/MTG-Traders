<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 07/02/2018
 * Time: 16:17
 */

session_start();

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/models/User.php';
require_once __DIR__ . '/../src/models/Advert.php';

if (!isset($_SESSION["user"])) {
    $_SESSION["loginError"] = "You must login to access this page";
    header('Location: /login.php');
} else if (!isset($_GET["id"])) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else {
    $advert = Advert::getAdvertFromID($_GET["id"]);

    $advert = Advert::prepareAdvertFromAdvertArray($advert);

    $user = User::getUserFromID((int)$advert["ownerid"]);

    $user = User::prepareUserFromUserArray($user);

    $view = new Template();

    $view->title  = "Contact";
    $view->user   = $user;
    $view->advert = $advert;

    $view->content = $view->render(__DIR__ . '/../views/contact.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
}