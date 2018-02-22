<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 15/02/2018
 * Time: 19:01
 */

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/models/Card.php';
require_once __DIR__ . '/../src/helpers/Paginate.php';

if (!isset($_GET["search"])) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else {
    $page = 1;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        $_SESSION["QUERY_STRING"] = substr($_SERVER["QUERY_STRING"], 0, strrpos( $_SERVER["QUERY_STRING"], '&'));
    } else {
        $_SESSION["QUERY_STRING"] = $_SERVER["QUERY_STRING"];
    }

    $cards = Card::searchCards($_GET["search"], $page, 10);

    $pagination = Paginate::createLinks((int)$page, $_SESSION["QUERY_STRING"] . "&", (int)Card::countSearchRows($_GET["search"])["COUNT(*)"], 10);

    for ($i = 0; $i < sizeof($cards); $i++)
    {
        $cards[$i] = Card::prepareCardFromCardArray($cards[$i]);
    }

    $view = new Template();

    $view->title      = "Search";
    $view->cards      = $cards;
    $view->pagination = $pagination;

    $view->content = $view->render(__DIR__ . '/../views/search.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
}