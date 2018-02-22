<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 13/02/2018
 * Time: 10:23
 */

require_once __DIR__ . "/User.php";
require_once __DIR__ . "/Card.php";
require_once __DIR__ . "/../helpers/Database.php";

class Advert
{
    static protected $table = "Adverts";

    //Gets the table from the variable $table
    public static function getTable(): string
    {
        return self::$table;
    }

    //Gets an advert based on the ID inputted
    public static function getAdvertFromID($advertID)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM `" . self::$table . "` WHERE `id` = :id";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $advertID));
        $response = $sth->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    //Adds an advert to the table and returns the response
    public static function addAdvert($cardid, $ownerid, $condition, $price, $expirydate, $imgname)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "INSERT INTO " . self::$table . " (`cardid`,`ownerid`,`condition`,`price`,`expirydate`,`imgname`)
                VALUES (:cardid,:ownerid,:condition,:price,:expirydate,:imgname)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ":cardid"     => $cardid,
                ":ownerid"    => $ownerid,
                ":condition"  => $condition,
                ":price"      => $price,
                ":expirydate" => $expirydate,
                ":imgname"    => $imgname
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

    //Gets paginated adverts based on the limit, page number and filters
    public static function getPaginatedAdvertsFromCardID($cardid, $page = 1, $endingsoonest = 0, $lowestcost = 0, $condition = 0, $limit)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT * FROM `" . self::$table . "` WHERE cardid = :cardid AND expirydate > NOW()";

            if ($endingsoonest === 1 || $lowestcost === 1 || $condition === 1) {
                $sql = $sql . "ORDER BY ";

                if ($endingsoonest === 1) {
                    $sql = $sql . "`expirydate` ASC,";
                }

                if ($lowestcost === 1) {
                    $sql = $sql . "`price` ASC,";
                }

                if ($condition === 1) {
                    $sql = $sql . "`condition` ASC,";
                }

                $sql = substr($sql, 0, -1) . " ";
            }

            $sql = $sql . "LIMIT " . ($page - 1) * $limit . ", " . $limit;

            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(":cardid" => $cardid));
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Gets paginated adverts based on the page number and limit
    public static function getPaginatedAdverts($page = 1, $limit)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT * FROM `" . self::$table . "` WHERE expirydate > NOW()";

            $sql = $sql . "LIMIT " . ($page - 1) * $limit . ", " . $limit;

            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Gets paginated expired adverts based on page number and limit
    public static function getPaginatedExpiredAdverts($page = 1, $limit)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT * FROM `" . self::$table . "` WHERE expirydate < NOW()";

            $sql = $sql . "LIMIT " . ($page - 1) * $limit . ", " . $limit;

            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Counts the rows for the adverts based on the provided card ID
    public static function countRowsFromID($cardid)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT COUNT(*) FROM `" . self::$table . "` WHERE cardid = :cardid AND expirydate > NOW()";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(":cardid" => $cardid));
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Counts how many adverts are in the database that have not expired
    public static function countRows()
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT COUNT(*) FROM `" . self::$table . "` WHERE expirydate > NOW()";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Counts how many adverts are in the database that have expired
    public static function countExpiredRows()
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT COUNT(*) FROM `" . self::$table . "` WHERE expirydate < NOW()";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Deletes an advert from the database
    public static function deleteAdvert($advertid)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "DELETE FROM " . self::$table . " WHERE id = :advertid";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ":advertid" => (int)$advertid
            ));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //Prepares the adverts for displaying on a page
    public static function prepareAdvertFromAdvertArray($advert)
    {
        //Returns the user and puts their name into the advert array
        $user = User::getUserFromID((int)$advert["ownerid"]);

        $advert["username"] = $user["firstname"] . " " . $user["lastname"];

        //Gets the condition from the array and replaces it with a textual representation of the condition
        switch ($advert["condition"]) {
            case 1:
                $advert["condition"] = "Mint";
                break;
            case 2:
                $advert["condition"] = "Near Mint";
                break;
            case 3:
                $advert["condition"] = "Lightly Played";
                break;
            case 4:
                $advert["condition"] = "Moderately Played";
                break;
            case 5:
                $advert["condition"] = "Heavily Played";
                break;
            default:
                $advert["condition"] = "Unknown Condition";
                break;
        }

        //Ensures the price is two decimal places
        $advert["price"] = number_format($advert["price"], 2, ".", ",");

        //Formats the expiry date in a human readable format
        $date1 = new DateTime(null, new DateTimeZone('Europe/London'));
        $date2 = new DateTime($advert["expirydate"]);

        $advert["expiresin"] = $date2->diff($date1)->format("%a days");
        if ($advert["expiresin"] == "0 days") {
            $advert["expiresin"] = $date2->diff($date1)->format("%h hours");

            if ($advert["expiresin"] == "0 hours") {
                $advert["expiresin"] = $date2->diff($date1)->format("%i minutes");

                if ($advert["expiresin"] == "0 minutes") {
                    $advert["expiresin"] = $date2->diff($date1)->format("%s seconds");
                }
            }
        }

        $expirydate = new DateTime($advert["expirydate"]);

        $advert["expirydate"] = $expirydate->format('d/m/Y H:i:s');

        //Gets the card name and adds it to the array
        $advert["cardname"] = Card::getCardFromID((int)$advert["cardid"])["cardname"];

        return $advert;
    }
}