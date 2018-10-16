<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
const ERROR = "Oops, smth go wrong(";
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["name"])){
    $_SESSION["error"] = ERROR;
    header("location:   ../index.php");
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"])) {
    $config = require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR
        . "private" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";
    include_once($config["jsonManipulate"]);
    $jsonHandle = new jsonManipulate($config["voteDB"], $_POST["name"]);
    $jsonHandle->makeVote();
    $data = $jsonHandle->getVotes();
    if ($data === false) {
        return ERROR;
    }
    $_SESSION["votes"] = $data;
    header("location: {$config["votePage"]}");
}









