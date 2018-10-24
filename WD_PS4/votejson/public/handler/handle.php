<?php
/** @noinspection PhpIncludeInspection */
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
const ERROR = "Oops, smth go wrong(";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    errorRedirection(ERROR);
}
if (isset($_POST["name"])) {
    try {
        $config = require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR
            . "private" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";
        if (!isset($config["jsonManipulate"]) || !isset($config["voteDB"]) || !isset($config["votePage"])) {
            throw new Exception('Config file broken!');
        }
        include_once($config["jsonManipulate"]);
        $jsonHandle = new jsonManipulate($config["voteDB"], $_POST["name"]);
        $jsonHandle->makeVote();
        $_SESSION["votes"] = $jsonHandle->convertDbToCharts();
        header("location: {$config["votePage"]}");
    } catch (Exception $e) {
        errorRedirection($e->getMessage());
    }
} else {
    errorRedirection(ERROR);
}

function errorRedirection($errorMsg)
{
    $_SESSION["error"] = $errorMsg;
    header("location:   ../index.php");
}









