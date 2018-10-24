<?php

/** @noinspection PhpUnhandledExceptionInspection */

$config["voteDB"] = dirname(__DIR__) . DIRECTORY_SEPARATOR . "json" . DIRECTORY_SEPARATOR . "vote.json";
$config["jsonManipulate"] = dirname(__DIR__) . DIRECTORY_SEPARATOR . "jsonManipulate" . DIRECTORY_SEPARATOR .
    "jsonManipulate.php";

if (!file_exists($config["jsonManipulate"]) || !file_exists($config["voteDB"])) {
    throw new Exception('Config file broken!');
}

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "jsonManipulate" . DIRECTORY_SEPARATOR .
    "jsonManipulate.php";