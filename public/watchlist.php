<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 15/02/2018
 * Time: 15:21
 */

session_start();

if (!isset($_SESSION["user"])) {
    $_SESSION["loginError"] = "You must login to access this page";
    header('Location: /login.php');
}

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

$page = 1;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/helpers/Paginate.php';
require_once __DIR__ . '/../src/models/Watchlist.php';

$watchlist = Watchlist::getPaginatedWatchlist($page, 50);

$pagination = Paginate::createLinks($page, "", (int)Watchlist::countRows()["COUNT(*)"], 50);

for ($i = 0; $i < sizeof($watchlist); $i++)
{
    $watchlist[$i] = Watchlist::prepareWatchlistItemFromArray($watchlist[$i]);
}

$view = new Template();

$view->title       = "Watchlist";
$view->user        = $_SESSION["user"];
$view->watchlist   = $watchlist;
$view->pagination  = $pagination;
$view->responsebag = $responsebag;
$view->errorbag    = $errorbag;

$view->content = $view->render(__DIR__ . '/../views/watchlist.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');