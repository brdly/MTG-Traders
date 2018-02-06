<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 30/01/2018
 * Time: 10:07
 */

namespace MtG;

class User
{
    static protected $table = "users";

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }
}