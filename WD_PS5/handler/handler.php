<?php

/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpIncludeInspection */

if (($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['className']) ||
    ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['className'])))) {
    header('location: ../public/index.php');
    die();
}

session_start();

use classes\CheckValuesAndSetManipulateClass;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'autoloader.php';

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

define('DATADB', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'json' . DIRECTORY_SEPARATOR . 'messages.json');

define('USERSDB', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'json' . DIRECTORY_SEPARATOR . 'users.json');

$checkValuesAndSetFunction = new CheckValuesAndSetManipulateClass();
$manipulateClass = $checkValuesAndSetFunction->getClass();
$manipulateClass->mainFunction();
