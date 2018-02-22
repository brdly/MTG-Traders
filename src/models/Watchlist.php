<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 20:34
 */

require_once __DIR__ . "/../helpers/Database.php";
require_once __DIR__ . "/../models/Card.php";

class Watchlist
{
    static protected $table = "Wishlist";

    //Returns the table from $table
    public static function getTable(): string
    {
        return self::$table;
    }

    //Adds a card to the watchlist
    public static function addCardToWatchlist($advertid, $userid)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "INSERT INTO " . self::$table . " (`userid`,`advertid`)
                VALUES (:userid,:advertid)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ":userid"   => (int)$userid,
                ":advertid" => (int)$advertid
            ));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //Removes a card from the watchlist
    public static function removeCardFromWatchlist($advertid, $userid)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "DELETE FROM " . self::$table . " WHERE userid = :userid AND advertid = :advertid";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ":userid"   => (int)$userid,
                ":advertid" => (int)$advertid
            ));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //Checks a card is in the users watchlist
    public static function isInWatchList($advertid, $userid)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "SELECT * FROM " . self::$table . " WHERE userid = :userid AND advertid = :advertid";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ":userid"   => $userid,
                ":advertid" => $advertid
            ));
            return $sth->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    //Returns a paginated set of adverts based on the page and limit
    public static function getPaginatedWatchlist($page = 1, $limit)
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

    //Counts the number of rows in the table
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

    //Prepares the advert for displaying on the site
    public static function prepareWatchlistItemFromArray($watchlistItem)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            //Uses a table join to return the required data from the Users and Adverts table for the advert
            $sql = "SELECT Users.firstname, Users.lastname, Adverts.condition, Adverts.price, Adverts.cardid, Adverts.expirydate FROM `Adverts`
                    INNER JOIN Users ON Adverts.ownerid = Users.id
                    WHERE Adverts.id = :advertid";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(":advertid" => $watchlistItem["advertid"]));
            $watchlistItem["details"] = $sth->fetch(PDO::FETCH_ASSOC);

            //Gets the card details
            $watchlistItem["card"] = Card::getCardFromID($watchlistItem["details"]["cardid"]);

            //Sets the expiry date format
            $expirydate = new DateTime($watchlistItem["details"]["expirydate"]);

            $watchlistItem["details"]["expirydate"] = $expirydate->format('d/m/Y H:i:s');

            //Sets the price to two decimal places
            $watchlistItem["details"]["price"] = number_format($watchlistItem["details"]["price"], 2, ".", ",");

            //Sets the condition to a human readable format
            switch ($watchlistItem["details"]["condition"]) {
                case 1:
                    $watchlistItem["details"]["condition"] = "Mint";
                    break;
                case 2:
                    $watchlistItem["details"]["condition"] = "Near Mint";
                    break;
                case 3:
                    $watchlistItem["details"]["condition"] = "Lightly Played";
                    break;
                case 4:
                    $watchlistItem["details"]["condition"] = "Moderately Played";
                    break;
                case 5:
                    $watchlistItem["details"]["condition"] = "Heavily Played";
                    break;
                default:
                    $watchlistItem["details"]["condition"] = "Unknown Condition";
                    break;
            }
        } catch (PDOException $e) {
            var_dump($e);
        }

        return $watchlistItem;
    }
}