<?php
/** @noinspection PhpIncludeInspection */
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
const ERROR = "Oops, smth go wrong(";
const MIN_NAME_LENGTH = 4;
const MIN_PASS_LENGTH = 6;
if ($_SERVER["REQUEST_METHOD"] !== "POST" && (!isset($_POST["name"]) || !isset($_POST["UserName"]))) {
    errorRedirection(ERROR);
}
$config = connectConfig();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"])) {
    loginUser($config);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["UserName"])) {
    addMessage($config);
}

function addMessage($config)
{
    echo $_POST["UserName"];
    try {
        if (strlen($_POST["UserMessage"]) === 0) {
            throw new Exception('Empty message!');
        }
        include_once($config["sendMsgManipulate"]);
        $jsonHandle = new sendMsgManipulate($config["usersDB"], $_POST["UserName"], $_POST["UserMessage"]);

//        $jsonHandle->submitLogin();
//        $_SESSION["user_name"] = $_POST["name"];
//        header("location: ../chat.php");
    } catch (Exception $e) {
        errorRedirection($e->getMessage());
    }
    echo $jsonHandle->writeMessage();
}

function loginUser($config)
{
    try {
        if (strlen($_POST["name"]) < MIN_NAME_LENGTH) {
            throw new Exception('Name should exist 4 character at least!');
        }
        if (strlen($_POST["password"]) < MIN_PASS_LENGTH) {
            throw new Exception('Password should exist 6 character at least!');
        }
        include_once($config["loginManipulate"]);
        $jsonHandle = new loginManipulate($config["usersDB"], $_POST["name"], $_POST["password"]);
        $jsonHandle->submitLogin();
        $_SESSION["user_name"] = $_POST["name"];
        header("location: ../chat.php");
    } catch (Exception $e) {
        errorRedirection($e->getMessage());
    }
}

function connectConfig()
{
    try {
        $config = require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR
            . "private" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";
        if (!isset($config["dataDB"]) || !isset($config["usersDB"]) || !isset($config["loginManipulate"]) ||
            !isset($config["sendMsgManipulate"])) {
            throw new Exception('Config file broken!');
        }
    } catch (Exception $e) {
        errorRedirection($e->getMessage());
    }
    return $config;
}

function errorRedirection($errorMsg)
{
    $_SESSION["error"] = $errorMsg;
    header("location:   ../index.php");
}