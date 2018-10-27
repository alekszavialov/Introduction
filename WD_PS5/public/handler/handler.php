<?php

/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpIncludeInspection */

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'dbConfig.php';

$checkValuesAndSetFunction = new checkValuesAndSetManipulateClass();
$manipulateClass = $checkValuesAndSetFunction->getClass();
$manipulateClass->mainFunction();

function __autoload($className)
{
    if (file_exists(CLASSES_DIR . "$className.php")){
        require_once(CLASSES_DIR . "$className.php");
    } else {
        pageRedirection::errorRedirection(ERROR);
    }
}










