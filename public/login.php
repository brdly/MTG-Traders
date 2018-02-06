<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 10:51
 */

require_once __DIR__ . '/../src/helpers/Template.php';

use MtG\Helper\Template;

$view = new Template();

$view->title = "Login";

$view->content = $view->render(__DIR__ . '/../views/login.php');
echo $view->render(__DIR__ . '/../views/templates/main.php');