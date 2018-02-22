<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 19:27
 */

session_start();

require_once __DIR__ . '/../src/helpers/Template.php';

if (!isset($_SESSION["user"]) || (int)$_SESSION["user"]["id"] !== 1) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else {
    $view = new Template();

    $view->title = "Admin";
    $view->user  = $_SESSION["user"];

    $view->content = $view->render(__DIR__ . '/../views/admin.php');
    echo $view->render(__DIR__ . '/../views/templates/adminpanel.php');
}