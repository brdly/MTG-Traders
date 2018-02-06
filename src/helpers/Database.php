<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 30/01/2018
 * Time: 10:06
 */
namespace MtG\Helper;

require_once __DIR__ . "/../../config.php";

use Config;
use PDO;
use PDOException;

class Database
{
    protected $dbh;

    public function __construct()
    {
        $dsn = "mysql:dbname=" . Config::$dbName . ";host=" . Config::$dbHost;
        $user = Config::$dbUsername;
        $password = Config::$dbPassword;
        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
            $this->dbh = null;
        }
    }

    /**
     * @return null
     */
    public function getDbh()
    {
        return $this->dbh;
    }
}