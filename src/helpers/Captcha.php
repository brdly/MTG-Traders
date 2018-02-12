<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 11/02/2018
 * Time: 17:02
 */

class Captcha
{
    public static function generateCode()
    {
        $string = '';

        for ($i = 0; $i < 5; $i++) {
            $string .= chr(rand(97, 122));
        }

        return $string;
    }

    public static function create($code)
    {
        //Doesn't work on my PHP version. :(

        $dir = './fonts/';

        $image = imagecreatetruecolor(170, 60);
        $black = imagecolorallocate($image, 0, 0, 0);
        $color = imagecolorallocate($image, 200, 100, 90); // red
        $white = imagecolorallocate($image, 255, 255, 255);

        imagefilledrectangle($image,0,0,200,100,$white);
        imagettftext($image, 30, 0, 10, 40, $color, $dir."Roboto.ttf", $code);

        header("Content-type: image/png");
        imagepng($image);
    }
}