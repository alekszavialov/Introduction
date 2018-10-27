<?php

/**
 * Created by PhpStorm.
 * User: dslife
 * Date: 10/26/2018
 * Time: 12:34 AM
 */

class pageRedirection
{
    public static function errorRedirection($errorMsg)
    {
        $_SESSION["error"] = $errorMsg;
        header("location:   ../index.php");
    }

    public static function chatPageRedirection()
    {
        header("location:   ../chat.php");
    }

}