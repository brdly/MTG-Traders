<?php
require_once __DIR__ . '/../src/helpers/Template.php';

use MtG\Helper\Template;

$view = new Template();

$view->title = "Home";

$view->content = $view->render(__DIR__ . '/../views/home.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');