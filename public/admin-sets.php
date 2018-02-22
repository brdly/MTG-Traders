<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 21:49
 */

session_start();

require_once __DIR__ . '/../src/helpers/Template.php';
require_once __DIR__ . '/../src/models/Set.php';
require_once __DIR__ . '/../src/helpers/Paginate.php';

if (!isset($_SESSION["user"]) || (int)$_SESSION["user"]["id"] !== 1) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/main.php');
} else {
    $page = 1;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $sets = Set::getPaginatedSets($page, 50);

    $pagination = Paginate::createLinks($page, "", (int)Set::countRows()["COUNT(*)"], 50);

    $view = new Template();

    $view->title = "Sets";
    $view->sets = $sets;
    $view->pagination = $pagination;

    $view->content = $view->render(__DIR__ . '/../views/admin/sets.php');
    echo $view->render(__DIR__ . '/../views/templates/adminpanel.php');
}