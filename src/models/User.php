<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 30/01/2018
 * Time: 10:07
 */

require_once __DIR__ . "/../helpers/Database.php";
require_once __DIR__ . "/../helpers/CountryCode.php";

class User
{
    static protected $table = "Users";

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    public static function createUser($firstname, $lastname, $email, $password, $addrLine1, $addrLine2, $addrLine3, $city, $country, $postcode, $phoneNum)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "INSERT INTO " . self::$table . " (`firstname`,`lastname`,`email`,`password`,`addrline1`,`addrline2`,`addrline3`,`city`,`country`,`postcode`,`phonenum`)
                VALUES (:firstname,:lastname,:email,:password,:addrline1,:addrline2,:addrline3,:city,:country,:postcode,:phonenum)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ":firstname" => $firstname,
                ":lastname"  => $lastname,
                ":email"     => $email,
                ":password"  => password_hash($password, PASSWORD_DEFAULT),
                ":addrline1" => $addrLine1,
                ":addrline2" => $addrLine2,
                ":addrline3" => $addrLine3,
                ":city"      => $city,
                ":country"   => $country,
                ":postcode"  => $postcode,
                ":phonenum"  => $phoneNum
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

    public static function login($email, $password)
    {
        $dbh = new Database();

        $dbh = $dbh::getDbh();

        $sql = "SELECT * FROM " . self::$table . " WHERE `email` = :email";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(":email" => $email));
        $response = $sth->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $response["password"])) {
            unset($response["password"]);
            $response["country"] = CountryCode::convertToCountry($response["country"]);
            return $response;
        } else {
            return $response;
        }
    }
}