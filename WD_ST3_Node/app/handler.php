<?php


use app\Database;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Database.php';

$database = new Database();

if (isset($_GET['function']) && method_exists($database, $_GET['function'])) {
    $database->loadItems();
}



if (isset($_POST['function']) && method_exists($database, $_POST['function'])) {
    if ($_POST['function'] === 'insertItem') {
        $database->insertItem($_POST['positionX'], $_POST['positionY'], $_POST['message']);
    } else if ($_POST['function'] === 'editItem') {

        $database->editItem($_POST['id'], $_POST['positionX'], $_POST['positionY'], $_POST['message']);
    }
}
