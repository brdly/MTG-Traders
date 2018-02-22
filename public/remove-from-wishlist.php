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
} else if (!isset($_GET["id"])) {
    // Check a Advert ID were passed to the page

    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else if (!isset($_GET["page"])) {
    //Check a Card ID was passed to the page

    //Get Advert ID

    $advertID = $_GET['id'];

    //Get User ID

    $userID = $_SESSION["user"]["id"];

    //Remove advert from watchlist for user

    if (Watchlist::removeCardFromWatchlist($advertID, $userID)) {
        $_SESSION["watchlistResponse"] = "Advert successfully removed from your watchlist";
        header('Location: /watchlist.php');
    } else {
        $_SESSION["watchlistError"] = "Advert could not be removed from your watchlist";
        header('Location: /watchlist.php');
    }

} else {
    //Get Card ID

    $cardID = $_GET["page"];

    //Get Advert ID

    $advertID = $_GET['id'];

    //Get User ID

    $userID = $_SESSION["user"]["id"];

    //Add User and Card to Watchlist and redirect to card page

    if (Watchlist::removeCardFromWatchlist($advertID, $userID)) {
        $_SESSION["watchlistResponse"] = "Advert successfully removed from your watchlist";
        header('Location: /card.php?id=' . $cardID);
    } else {
        $_SESSION["watchlistError"] = "Advert could not be removed from your watchlist";
        header('Location: /card.php?id=' . $cardID);
    }
}
