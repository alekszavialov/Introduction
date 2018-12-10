<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 12/7/2018
 * Time: 12:07 AM
 */

use app\Database;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'constants.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['getBlocks'])) {
    $Database = new Database();
    $Database->load();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addNewDiv'])) {
    $Database = new Database();
    $Database->insert($_POST['positionX'], $_POST['positionY'], $_POST['message']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changeBlock'])) {
    $Database = new Database();
    $Database->edit($_POST['id'], $_POST['positionX'], $_POST['positionY'], $_POST['message']);
}
