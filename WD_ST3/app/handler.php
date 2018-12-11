<?php

use app\Database;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Database.php';

define('MAX_MESSAGE_LENGHT', 255);

$database = new Database();

if (isset($_GET['function']) && method_exists($database, $_GET['function'])) {
    $database->loadItems();
} else if (isset($_POST['function'])
    && method_exists($database, $_POST['function'])
    && isset($_POST['positionX'])
    && isset($_POST['positionY'])
    && isset($_POST['message'])
    && strlen($_POST['message']) <= MAX_MESSAGE_LENGHT) {
    if (isset($_POST['id'])) {
        $database->editItem($_POST['id'], $_POST['positionX'], $_POST['positionY'], $_POST['message']);
    } else {
        $database->insertItem($_POST['positionX'], $_POST['positionY'], $_POST['message']);
    }
} else {
    http_response_code(202);
    echo 'bad query!';
}
