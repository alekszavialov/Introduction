<?php

/**
 * Created by PhpStorm.
 * User: dslife
 * Date: 10/26/2018
 * Time: 12:34 AM
 */

namespace core;

class phpResponse
{
    public static function pageRedirection($errorMsg, $location)
    {
        if (!empty($errorMsg)) {
            $_SESSION["error"] = $errorMsg;
        }
        header("location:   ../$location");
        die();
    }

    public static function ajaxResponse($responseCode, $data = null)
    {
        if ($responseCode === 200) {
            echo $result = json_encode($data);
        } else {
            http_response_code($responseCode);
            echo $data;
        }
        die();
    }

}
