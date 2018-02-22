<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 20:37
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
} else if (!isset($_GET["id"])) {
    $view = new Template();

    $view->title = "404";

    $view->content = $view->render(__DIR__ . '/../views/errors/404.php');
    echo $view->render(__DIR__ . '/../views/templates/adminpanel.php');
} else {
    $setID = $_GET['id'];
    $set = Set::getSetFromID($setID);

    $set = Set::prepareSetFromSetArray($set);

    $view = new Template();

    $view->title = "Set " . $setID;
    $view->set = $set;

    $view->content = $view->render(__DIR__ . '/../views/admin/sets-detail.php');
    echo $view->render(__DIR__ . '/../views/templates/adminpanel.php');
}