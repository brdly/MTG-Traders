<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 10:51
 */

session_start();

if (isset($_SESSION["user"])) {
    header('Location: /');
}

$responsebag = array();

if (isset($_SESSION["registerResponse"])) {
    array_push($responsebag, $_SESSION["registerResponse"]);

    unset($_SESSION["registerResponse"]);
}

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/models/User.php';

$errorbag = array();

if (count($_POST) > 0)
{
    $response = User::login($_POST['email'], $_POST['password']);
    if ($response != false) {
        $_SESSION["user"] = $response;
        $_SESSION["loginResponse"] = "Successfully logged in.";

        header('Location: /account.php');
    } else {
        array_push($errorbag, "Username or password do not match");
    }
}

if (isset($_SESSION["loginError"])) {
    array_push($errorbag, $_SESSION["loginError"]);

    unset($_SESSION["loginError"]);
}


$view = new Template();

$view->title = "Login";
$view->errorbag = $errorbag;
$view->responsebag = $responsebag;

$view->content = $view->render(__DIR__ . '/../views/login.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');