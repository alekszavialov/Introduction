<?php

/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpIncludeInspection */

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

use manipulate\CheckValuesAndSetManipulateClass as CheckValuesAndSetManipulateClass;
use manipulate\phpResponse as phpResponse;

require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'dbConfig.php';

$checkValuesAndSetFunction = new CheckValuesAndSetManipulateClass();
$manipulateClass = $checkValuesAndSetFunction->getClass();
$manipulateClass->mainFunction();

function __autoload($className)
{
    $className = explode('\\', $className);
    $className = end($className);
    if (file_exists(CLASSES_DIR . "$className.php")) {
        require_once(CLASSES_DIR . "$className.php");
    } else {
        phpResponse::pageRedirection(ERROR, 'index.php');
    }
}
