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
        require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR
            . "config" . DIRECTORY_SEPARATOR . "config.php";
        $jsonHandle = new jsonManipulate($config["voteDB"], $_POST["name"]);
        $jsonHandle->makeVote();
        $_SESSION["votes"] = $jsonHandle->convertDbToCharts();
        header("location: ../showVotes.php");
    } catch (Exception $e) {
        errorRedirection($e->getMessage());
    }
} else {
    errorRedirection(ERROR);
}

function errorRedirection($errorMsg)
{
    $_SESSION["error"] = $errorMsg;
    header("location: ../index.php");
}