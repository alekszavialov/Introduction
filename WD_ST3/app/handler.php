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

//echo $_SERVER['REQUEST_METHOD'] . '<br />';
//echo empty($_GET) ? "1" . '<br />' : "2" . '<br />';
//
//$testArray = [
//    [
//        'id' => '1',
//        'positionX' => '200',
//        'positionY' => '200',
//        'message' => 'test',
//    ],
//    [
//        'id' => '3',
//        'positionX' => '200',
//        'positionY' => '200',
//        'message' => 'test',
//    ],
//    [
//        'id' => '13',
//        'positionX' => '200',
//        'positionY' => '200',
//        'message' => 'test',
//    ]
//];
//
//$id = (array_search('1', array_column($testArray, 'id')));
//echo $id . '<br />';
//echo $testArray[$id]['message'] . '<br />';
//
//$testArray[$id]['message'] = '124412';
//echo $testArray[$id]['message'] . '<br />';

//if (!$_SERVER['REQUEST_METHOD']) {
//    header('location: ../public/index.php');
//}
//
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $Database = new Database();
    $Database->load();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addNewDiv'])){
    $Database = new Database();
    $Database->insert($_POST['positionX'], $_POST['positionY']);
}


//$text = $_POST['text'];
//$this->db->insert('data', ['text' => $text]);
//$data = array('text' => $text, 'id' => $this->db->lastInsertId());
//echo json_encode($data);
