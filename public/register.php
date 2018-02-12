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
require_once __DIR__ . '/../src/helpers/Captcha.php';
require_once __DIR__ . '/../src/helpers/CountryCode.php';
require_once __DIR__ . '/../src/models/User.php';

$errorbag = array();

$arrayVals = array(
    "firstname"            => "First Name",
    "lastname"             => "Last Name",
    "email"                => "Email Address",
    "password"             => "Password",
    "passwordconfirmation" => "Password Confirmation",
    "addrline1"            => "Address Line 1",
    "addrline2"            => "Address Line 2",
    "addrline3"            => "Address Line 3",
    "city"                 => "City",
    "country"              => "Country",
    "postcode"             => "Post Code",
    "phonenum"             => "Phone Number"
);

if (count($_POST) > 0)
{
    if ($_POST["firstname"]            !== "" &&
        $_POST["lastname"]             !== "" &&
        $_POST["email"]                !== "" &&
        $_POST["password"]             !== "" &&
        $_POST["passwordconfirmation"] !== "" &&
        $_POST["addrline1"]            !== "" &&
        $_POST["city"]                 !== "" &&
        $_POST["country"]              !== "" &&
        $_POST["postcode"]             !== "" &&
        $_POST["phonenum"]             !== ""
    ) {
        if ($_POST["verify"] == $_SESSION["firstNum"] + $_SESSION["secondNum"]) {
            if ($_POST["password"] === $_POST["passwordconfirmation"]) {

                $response = User::createUser(
                    $_POST["firstname"],
                    $_POST["lastname"],
                    $_POST["email"],
                    $_POST["password"],
                    $_POST["addrline1"],
                    $_POST["addrline2"],
                    $_POST["addrline3"],
                    $_POST["city"],
                    $_POST["country"],
                    $_POST["postcode"],
                    $_POST["phonenum"]
                );

                if ($response === true) {
                    $_SESSION["registerResponse"] = "Successfully registered, please login.";

                    header('Location: /login.php');
                } else {
                    array_push($errorbag, $response);
                }
            } else {
                array_push($errorbag, "Password and Confirmation do not match.");
            }
        } else {
            array_push($errorbag, "Captcha response incorrect, please check and try again.");
        }
    } else {
        foreach ($_POST as $key => $value)
        {
            if ($value === "" && $key !== "addrline2" && $key !== "addrline3" && $key !== "verify") {
                array_push($errorbag, $arrayVals[$key] . " is not provided. \n");
            }
        }
    }
}

$_SESSION["firstNum"]  = rand(12,50);
$_SESSION["secondNum"] = rand(12,50);

$view = new Template();

$view->title     = "Register";
$view->countries = CountryCode::getCountryList();
$view->errorbag  = $errorbag;
$view->captcha   = array($_SESSION["firstNum"],$_SESSION["secondNum"]);

$view->content = $view->render(__DIR__ . '/../views/register.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');