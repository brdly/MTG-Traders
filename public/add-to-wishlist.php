<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 15/02/2018
 * Time: 14:34
 */

session_start();

require_once __DIR__ . '/../src/models/Watchlist.php';

if (!isset($_SESSION["user"])) {
    // Check the user is logged in

    $_SESSION["loginError"] = "You must login to add items to your watchlist";
    header('Location: /login.php');
} else if (!isset($_GET["id"]) && !isset($_GET["page"])) {
    // Check a Card ID and Advert ID were passed to the page

    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else {
    //Get Card ID

    $cardID = $_GET["page"];

    //Get Advert ID

    $advertID = $_GET['id'];

    //Get User ID

    $userID = $_SESSION["user"]["id"];

    //Add User and Card to Watchlist and redirect to card page

    if (Watchlist::addCardToWatchlist($advertID, $userID)) {
        $_SESSION["watchlistResponse"] = "Advert successfully added to your watchlist";
        header('Location: /card.php?id=' . $cardID);
    } else {
        $_SESSION["watchlistError"] = "Advert could not be added to your watchlist";
        header('Location: /card.php?id=' . $cardID);
    }
}
