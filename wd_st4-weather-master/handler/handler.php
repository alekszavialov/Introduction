<?php

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest' ||
    !isset($_GET['function'])) {
    header('location: ../public/index.html');
}

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'autoloader.php';
$className = 'app' . DIRECTORY_SEPARATOR . $_GET['function'];
$configPath = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
$classData = $_GET['function'];
if (isset($configPath[$classData])){
    $weather = new $className($configPath[$classData]);
}
if (!isset($weather)){
    echo json_encode('Oppps, try again later(');
    die();
}
echo json_encode($weather->getData());