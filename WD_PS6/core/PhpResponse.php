<?php

namespace core;

class PhpResponse
{

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
