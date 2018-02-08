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

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/helpers/CountryCode.php';
require_once __DIR__ . '/../src/models/User.php';

$errorbag = array();

if (count($_POST) > 0)
{
    if ($_POST["password"] === $_POST["passwordconfirmation"])
    {
        $response = User::createUser(
            $_POST["firstname"],
            $_POST["lastname"],
            $_POST[""]
        );
        if ($response != false) {
            $_SESSION["user"] = $response;

            header('Location: /account.php');
        }
    } else {
        array_push($errorbag, "Password and Confirmation do not match.");
    }
}
$view = new Template();

$view->title = "Register";
$view->countries = CountryCode::getCountryList();
$view->errorbag = $errorbag;

$view->content = $view->render(__DIR__ . '/../views/register.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');