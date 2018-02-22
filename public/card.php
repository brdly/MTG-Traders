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
require_once __DIR__ . '/../src/models/Advert.php';
require_once __DIR__ . '/../src/models/Watchlist.php';
require_once __DIR__ . '/../src/helpers/Paginate.php';

if (!isset($_GET["id"])) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else {
    $errorbag    = array();
    $responsebag = array();

    if (isset($_SESSION["watchlistResponse"])) {
        array_push($responsebag, $_SESSION["watchlistResponse"]);

        unset($_SESSION["watchlistResponse"]);
    }

    if (isset($_SESSION["watchlistError"])) {
        array_push($errorbag, $_SESSION["watchlistError"]);

        unset($_SESSION["watchlistError"]);
    }

    $cardID = $_GET['id'];

    $card = Card::getCardFromID($cardID);

    $page          = 1;
    $endingsoonest = "";
    $lowestcost    = "";
    $condition     = "";

    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        $_SESSION["QUERY_STRING"] = substr($_SERVER["QUERY_STRING"], 0, strrpos( $_SERVER["QUERY_STRING"], '&'));
    } else {
        $_SESSION["QUERY_STRING"] = $_SERVER["QUERY_STRING"];
    }

    $endingsoonestURL = $_SESSION["QUERY_STRING"] . "&endingsoonest=1";
    $lowestcostURL    = $_SESSION["QUERY_STRING"] . "&lowestcost=1";
    $conditionURL     = $_SESSION["QUERY_STRING"] . "&condition=1";

    if (isset($_GET["endingsoonest"])) {
        $endingsoonest = " active";

        $endingsoonestURL = str_replace("&endingsoonest=1", "", $_SESSION["QUERY_STRING"]);

        $advertEnding = 1;
    } else {
        $advertEnding = 0;
    }

    if (isset($_GET["lowestcost"])) {
        $lowestcost = " active";

        $lowestcostURL = str_replace("&lowestcost=1", "", $_SESSION["QUERY_STRING"]);

        $advertLowest = 1;
    } else {
        $advertLowest = 0;
    }

    if (isset($_GET["condition"])) {
        $condition = " active";

        $conditionURL = str_replace("&condition=1", "", $_SESSION["QUERY_STRING"]);

        $advertCondition = 1;
    } else {
        $advertCondition = 0;
    }

    $adverts = Advert::getPaginatedAdvertsFromCardID($card["id"], $page, $advertEnding, $advertLowest, $advertCondition, 8);

    for ($i = 0; $i < sizeof($adverts); $i++)
    {
        $adverts[$i] = Advert::prepareAdvertFromAdvertArray($adverts[$i]);
    }

    $paginator = Paginate::createLinks((int)$page, $_SESSION["QUERY_STRING"] . "&", (int)Advert::countRowsFromID((int)$cardID)["COUNT(*)"], 8);

    $view = new Template();

    $view->title            = $card["cardname"];
    $view->card             = Card::prepareCardFromCardArray($card);
    $view->adverts          = $adverts;
    $view->paginator        = $paginator;
    $view->queryString      = $_SESSION["QUERY_STRING"];
    $view->condition        = $condition;
    $view->lowestcost       = $lowestcost;
    $view->endingsoonest    = $endingsoonest;
    $view->conditionURL     = $conditionURL;
    $view->lowestcostURL    = $lowestcostURL;
    $view->endingsoonestURL = $endingsoonestURL;
    $view->responsebag      = $responsebag;
    $view->errorbag         = $errorbag;

    $view->content = $view->render(__DIR__ . '/../views/card.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
}