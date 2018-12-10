<?php

use app\Database;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Database.php';

$Database = new Database();
if (isset($_GET['function']) && function_exists($_GET['function'])) {
    $Database->load();
    die();
}
if (isset($_POST['function']) && function_exists($_POST['function'])) {
    if ($_POST['function'] === 'insertItem'){
        $Database->{$_POST['function']}($_POST['positionX'], $_POST['positionY'], $_POST['message']);
    } else if ($_POST['function'] === 'editItem'){
        $Database->{$_POST['function']}($_POST['id'], $_POST['positionX'], $_POST['positionY'], $_POST['message']);
    }
} else {
    echo json_encode('Incorrect query!');
}
