<?php
const ERROR = "Oops, smth go wrong(";
if (!isset($_POST["name"])){
    return ERROR;
}
$config = require_once   ".." . DIRECTORY_SEPARATOR . "private" .
    DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";
$jsonString = file_get_contents($config['vote']);
$data = json_decode($jsonString, true);
$radioVal = $_POST["name"];
foreach ($data['Users'] as &$value) {
    if ($value["name"] === $_POST["name"]){
        $value["votes"]++;
        unset($value);
        break;
    }
}
file_put_contents($config['vote'], json_encode($data));
$_SESSION["votes"] = $data;
header("location:../public/showVotes.php");




