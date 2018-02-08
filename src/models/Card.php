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

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

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

    public static function addCard($setid, $cardname, $manacost, $description, $flavourtext, $cardtype, $uncommon, $rare, $mythic, $power, $toughness, $loyalty)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

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
        $response = $sth->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    public static function getRandomCard()
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM " . self::$table . " ORDER BY RAND() LIMIT 1";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $response = $sth->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

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

    public static function prepareCardFromCardArray($card)
    {
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

        $set  = Set::getSetFromID($card["setid"]);

        $setSymbol = "<i class=\"ss ss-" . $set["setcode"];

        if ((int)$card["uncommon"] !== 0) {
            $setSymbol = $setSymbol . " ss-uncommon";
        } else if ((int)$card["rare"] !== 0) {
            $setSymbol = $setSymbol . " ss-rare";
        } else if ((int)$card["mythic"] !== 0) {
            $setSymbol = $setSymbol . " ss-mythic";
        } else {
            $setSymbol = $setSymbol . " ss-common";
        }

        $card["setsymbol"] = $setSymbol . " ss-grad\"></i>";

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