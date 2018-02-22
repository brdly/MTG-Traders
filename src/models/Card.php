<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 20:11
 */

require_once __DIR__ . "/../helpers/Database.php";
require_once __DIR__ . '/Set.php';

class Card
{
    static protected $table = "Cards";

    //Gets the table from the variable $table
    public static function getTable(): string
    {
        return self::$table;
    }

    //Gets paginated cards based on the page number and limit
    public static function getPaginatedCards($page = 1, $limit)
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

    //Counts how many cards are in the database
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

    //Counts how many cards are in the database that match the search provided
    public static function countSearchRows($search)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "SELECT COUNT(*) FROM `" . self::$table . "` WHERE `cardname` LIKE :search
                                                                   OR `description` LIKE :search
                                                                   OR `flavourtext` LIKE :search
                                                                   OR `cardtype` LIKE :search";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':search' => "%$search%"));
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    //Returns a card based on the ID provided
    public static function getCardFromID($cardID)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM `" . self::$table . "` WHERE `id` = :id";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $cardID));
        $response = $sth->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    //Searches the database for cards based on the search and paginates the data
    public static function searchCards($search, $page = 1, $limit)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM `" . self::$table . "` WHERE `cardname` LIKE :search
                                                        OR `description` LIKE :search
                                                        OR `flavourtext` LIKE :search
                                                        OR `cardtype` LIKE :search
                                                        LIMIT " . ($page - 1) * $limit . ", " . $limit;

        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':search' => "%$search%"));
        $response = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $response;
    }

    //Adds a card to the database
    public static function addCard($setid, $cardname, $manacost, $description, $flavourtext, $cardtype, $uncommon, $rare, $mythic, $power, $toughness, $loyalty)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "INSERT INTO " . self::$table . " (`setid`,`cardname`,`manacost`,`description`,`flavourtext`,`cardtype`,`uncommon`,`rare`,`mythic`,`power`,`toughness`,`loyalty`)
                    VALUES (:setid,:cardname,:manacost,:description,:flavourtext,:cardtype,:uncommon,:rare,:mythic,:power,:toughness,:loyalty)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ":setid" => $setid,
                ":cardname" => $cardname,
                ":manacost"   => $manacost,
                ":description"    => $description,
                ":flavourtext"   => $flavourtext,
                ":cardtype"   => $cardtype,
                ":uncommon"    => $uncommon,
                ":rare"   => $rare,
                ":mythic"   => $mythic,
                ":power"    => $power,
                ":toughness"   => $toughness,
                ":loyalty"   => $loyalty
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

    //Gets a random card from the database. Alternative to getRandomCards();
    public static function getRandomCard()
    {
        return self::getRandomCards(1)[0];
    }

    //Gets random cards limited by the provided limit
    public static function getRandomCards($limit)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM " . self::$table . " ORDER BY RAND() LIMIT " . $limit;
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $response = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $response;
    }

    //Prepares a card for viewing on the site
    public static function prepareCardFromCardArray($card)
    {
        //Parses the mana cost to show using provided SVG font.
        $manacost = "";

        $manacostArray = explode(",", $card["manacost"]);

        foreach ($manacostArray as $mana)
        {
            if (strlen($mana) == 1) {
                $manacost = $manacost . "<i class=\"ms ms-cost ms-" . $mana . "\"></i>";
            } else if (strpos($mana, "p") !== false) {
                $manacost = $manacost . "<i class=\"ms ms-cost ms-p ms-" . (str_split($mana, 1))[0] . "\"></i>";
            } else if ($mana === "") {
                $manacost = "";
            } else {
                $manacost = $manacost . "<i class=\"ms ms-cost ms-split ms-" . $mana . "\"></i>";
            }
        }

        $card["manacost"] = $manacost;

        //Gets the set ID and returns the set symbol, additionally checks if the card's rarity and assigns that to the set symbol
        $set  = Set::getSetFromID($card["setid"]);

        $setSymbol = "<i class=\"ss ss-" . $set["setcode"];

        if ((int)$card["uncommon"] !== 0) {
            $setSymbol = $setSymbol . " ss-uncommon";

            $rarity = "Uncommon";
        } else if ((int)$card["rare"] !== 0) {
            $setSymbol = $setSymbol . " ss-rare";

            $rarity = "Rare";
        } else if ((int)$card["mythic"] !== 0) {
            $setSymbol = $setSymbol . " ss-mythic";

            $rarity = "Mythic Rare";
        } else {
            $setSymbol = $setSymbol . " ss-common";

            $rarity = "Common";
        }

        $card["setsymbol"] = $setSymbol . " ss-grad\"></i>";

        $card["rarity"] = $rarity;

        $card["setname"] = $set["setname"];

        //Uses regex to modify the description to show correct icons
        $card["description"] = preg_replace("/(?:\+(\d+):)/", "<i class=\"ms ms-loyalty-up ms-loyalty-$1\"></i>:", $card["description"]);
        $card["description"] = preg_replace("/(?:\-(\d+):)/", "<i class=\"ms ms-loyalty-down ms-loyalty-$1\"></i>:", $card["description"]);
        $card["description"] = preg_replace("/(?:(0):)/", "<i class=\"ms ms-loyalty-zero ms-loyalty-$1\"></i>:", $card["description"]);
        $card["description"] = preg_replace("/(?:{([\dwubrgc]+)})/", "<i class=\"ms ms-cost ms-$1\"></i>", $card["description"]);
        $card["description"] = preg_replace("/(?:{([wubrg])p})/", "<i class=\"ms ms-cost ms-p ms-$1\"></i>", $card["description"]);
        $card["description"] = preg_replace("/(?:{([t])})/", "<i class=\"ms ms-cost ms-p ms-tap\"></i>", $card["description"]);

        $card["imagename"] = strtolower(preg_replace("/[^[:alnum:]]/u", '', $card["cardname"]));

        return $card;
    }
}