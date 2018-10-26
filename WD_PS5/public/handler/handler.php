<?php

/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpIncludeInspection */

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR
    . "config" . DIRECTORY_SEPARATOR . "config.php";

$checkValuesAndSetFunction = new checkValuesAndSetManipulateClass();
$checkValuesAndSetFunction->findFunctionByIncomeData();
$manipulateClass = $checkValuesAndSetFunction->getFunction();
$$manipulateClass = new $manipulateClass();
$$manipulateClass->mainFunction();

function __autoload($className)
{
    require_once(CLASSES_DIR . "$className.php");
}










