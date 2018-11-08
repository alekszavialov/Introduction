<?php

/**
 * Created by PhpStorm.
 * User: dslife
 * Date: 10/26/2018
 * Time: 12:34 AM
 */

class phpResponse
{
    public static function pageRedirection($errorMsg, $location)
    {
        if (!empty($errorMsg)){
            $_SESSION["error"] = $errorMsg;
        }
        header("location:   ../$location");
    }

    public static function ajaxResponse($responseCode, $data = null)
    {
        $response = ['data' => $data, 'responseCode' => $responseCode];
        if ($responseCode === 200){
            echo $result = json_encode(['data' => $data, 'responseCode' => $responseCode]);
        } else{
            print_r([$data,$responseCode]);
        }
        die();
    }

}
