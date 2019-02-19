<?php

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest' ||
    !isset($_GET['function'])) {
    header('location: ../public/index.html');
}

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'autoloader.php';

$className = 'app' . DIRECTORY_SEPARATOR . $_GET['function'];
$weather = new $className();

if (!$weather){
    echo on_encode('Oppps, try again later(');
}

echo json_encode('ok!');