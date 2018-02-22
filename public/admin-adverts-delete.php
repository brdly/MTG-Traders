<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 15/02/2018
 * Time: 22:41
 */

session_start();

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/models/Advert.php';

if (!isset($_SESSION["user"]) || (int)$_SESSION["user"]["id"] !== 1) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else if (!isset($_GET["id"])) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/adminpanel.php');
} else {
    $advertID = $_GET['id'];

    if (Advert::deleteAdvert($advertID)) {
        $_SESSION["advertResponse"] = "Advert successfully deleted";
        header('Location: /admin-adverts.php');
    } else {
        $_SESSION["advertError"] = "Advert could not be deleted";
        header('Location: /admin-adverts.php');
    }
}