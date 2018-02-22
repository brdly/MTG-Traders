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

    //Returns the table name from $table
    public static function getTable(): string
    {
        return self::$table;
    }

    //Returns a set based on it's ID
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

    //Returns paginated sets based on the limit provided
    public static function getPaginatedSets($page = 1, $limit)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT * FROM `" . self::$table . "` ";

            $sql = $sql . "LIMIT " . ($page - 1) * $limit . ", " . $limit;

            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Returns all sets
    public static function getAllSets()
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT * FROM `" . self::$table . "` ";

            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Counts number of sets in database
    public static function countRows()
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT COUNT(*) FROM `" . self::$table . "`";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Returns the sets based on each type
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

    //Adds set to the database
    public static function addSet($setname, $setcode, $block, $core, $other)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
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

            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return "A user with this email already exists, please supply a new email and try again.";
            } else {
                return "An unidentified error occurred, please check your input and try again.";
            }
        }
    }

    //Prepares set for showing on site
    public static function prepareSetFromSetArray($set)
    {

        //Sets the set type in the array in a human readable format
        if ((int)$set["block"] !== 0) {
            $type = "Block";
        } else if ((int)$set["core"] !== 0) {
            $type = "Core";
        } else if ((int)$set["Other"] !== 0) {
            $type = "Other";
        } else {
            $type = "Unknown";
        }

        $set["settype"] = $type;

        return $set;
    }
}