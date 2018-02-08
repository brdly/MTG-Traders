<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 20:34
 */

require_once __DIR__ . "/../helpers/Database.php";

class Set
{
    static protected $table = "Sets";

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    public static function getSetFromID($setID)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM `" . self::$table . "` WHERE `id` = :id";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $setID));
        $response = $sth->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    public static function getAllSets()
    {
        //
    }

    public static function getSetsFromType($setType)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM `" . self::$table . "` WHERE ". $setType . " = 1";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $response = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $response;
    }

    public static function addSet($setname, $setcode, $block, $core, $other)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "INSERT INTO " . self::$table . " (`setname`,`setcode`,`block`,`core`,`other`)
                VALUES (:setname,:setcode,:block,:core,:other)";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(
            ":setname" => $setname,
            ":setcode" => $setcode,
            ":block"   => $block,
            ":core"    => $core,
            ":other"   => $other
        ));
        $response = $sth->fetch(PDO::FETCH_ASSOC);

        return $response;
    }
}