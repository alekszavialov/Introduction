<?php

namespace core;

class PhpResponse
{

    public static function ajaxResponse($responseCode, $data = null, $service)
    {
        if ($responseCode === 200) {
            echo $result = json_encode($data);
            $data = 'success';
        } else {
            http_response_code($responseCode);
            echo $data;
        }
        if ($responseCode !== 202) {
            self::addLog($responseCode, $service, $data);
        }
        die();
    }

    private static function addLog($responseCode, $service, $message = '')
    {
        if (!file_exists(LOG_FILE) || !is_writable(LOG_FILE)) {
            return;
        }
        $responseCode = $responseCode !== 200 ? 'fail' : 'done';
        $date = date('Y-m-d H:i:s');
        $message = !empty($message) ? $message : 'null';
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : 'unknown';
        $ip = $_SERVER['REMOTE_ADDR'] ?: 'unknown';
        $log = "[Date: $date; Function: $service; Status: $responseCode; Message: $message; User: $user; IP: $ip]" . PHP_EOL;
        file_put_contents(LOG_FILE, $log, FILE_APPEND | LOCK_EX);
    }
}
