<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 30/01/2018
 * Time: 10:06
 */

require_once __DIR__ . "/../../config.php";

class Database
{
    protected static $dbh;

    //Creates a PDO database object
    public function __construct()
    {
        $dsn = "mysql:dbname=" . Config::$dbName . ";host=" . Config::$dbHost;
        $user = Config::$dbUsername;
        $password = Config::$dbPassword;
        try {
            self::$dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
            self::$dbh = null;
        }
    }

    //Returns a PDO database object
    public static function getDbh()
    {
        return self::$dbh;
    }
}