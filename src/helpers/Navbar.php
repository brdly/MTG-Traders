<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 07/02/2018
 * Time: 14:37
 */

require_once __DIR__ . "/../models/Set.php";

class Navbar
{
    public static function generate()
    {
        $navbar = array();

        $sets = array();

        $sets["core"] = Set::getSetsFromType("core");
        $sets["block"] = Set::getSetsFromType("block");
        $sets["other"] = Set::getSetsFromType("other");

        $navbar["sets"] = $sets;

        return $navbar;
    }
}