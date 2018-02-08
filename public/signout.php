<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 07/02/2018
 * Time: 16:07
 */

session_start();

session_destroy();

header('Location: /');