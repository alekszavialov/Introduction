<?php
/** @noinspection PhpIncludeInspection */
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
const ERROR = "Oops, smth go wrong(";
const MIN_NAME_LENGTH = 4;
const MAX_NAME_LENGTH = 20;
const MIN_PASS_LENGTH = 6;
const MAX_PASS_LENGTH = 16;
const LOGIN_REG = "([^\w\d-_])";
const PASSWORD_REG = "([^\w\d])";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    errorRedirection(ERROR);
}

$config = connectConfig();

if (isset($_POST["name"])) {
    include_once($config["jsonDBManipulate"]);
    loginUser($config);
} else
    if (isset($_POST["userMessage"])) {
        include_once($config["jsonDBManipulate"]);
        addMessage($config);
    } else if (isset($_POST["getMsg"])) {
        include_once($config["jsonDBManipulate"]);
        loadMessage($config);
    } else {
        errorRedirection(ERROR);
    }

function loadMessage($config)
{
    try {
        if (strlen($_POST["getMsg"]) === 0) {
            throw new Exception('Empty query!');
        }
        include_once($config["loadMsgManipulate"]);
        $jsonHandle = new loadMsgManipulate($config["dataDB"], $_SESSION["user_name"]);
        $jsonHandle->loadMessages();
        if (isset($_SESSION["messageCount"]) && $jsonHandle->getMessageCount() === $_SESSION["messageCount"]){
            return;
        }
        $_SESSION["messageCount"] = $jsonHandle->getMessageCount();
        echo($jsonHandle->getMessages());
    } catch (Exception $e) {
        echo "es";
    }


}

function addMessage($config)
{
    try {
        if (strlen($_POST["userMessage"]) === 0) {
            throw new Exception("Empty message!");
        }
        include_once($config["sendMsgManipulate"]);
        $jsonHandle = new sendMsgManipulate($config["dataDB"], $_SESSION["user_name"], $_POST["userMessage"]);
        $jsonHandle->writeMessage();
    } catch (Exception $e) {
        errorRedirection($e->getMessage());
    }
    if (isset($jsonHandle)) {
        echo $jsonHandle->getUserMessage();
    }
}

function loginUser($config)
{
    try {
        if (strlen($_POST["name"]) < MIN_NAME_LENGTH || preg_match(LOGIN_REG, $_POST["name"])) {
            throw new Exception("Name should exist 4 character at least or incorrect symbols!");
        }
        if (strlen($_POST["password"]) < MIN_PASS_LENGTH || preg_match(PASSWORD_REG, $_POST["password"])) {
            throw new Exception("Password should exist 6 character at least or incorrect symbols!");
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
        if (!isset($config["dataDB"]) || !isset($config["usersDB"]) || !isset($config["jsonDBManipulate"]) ||
            !isset($config["loginManipulate"]) || !isset($config["sendMsgManipulate"]) ||
            !isset($config["loadMsgManipulate"])) {
            throw new Exception("Config file broken!");
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