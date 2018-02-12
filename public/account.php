<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 07/02/2018
 * Time: 16:17
 */

session_start();

if (!isset($_SESSION["user"])) {
    header('Location: /login');
}

require_once __DIR__ . '/../src/helpers/Template.php';

$view = new Template();

$view->title = "Login";
$view->user  = $_SESSION["user"];

$view->content = $view->render(__DIR__ . '/../views/account.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');