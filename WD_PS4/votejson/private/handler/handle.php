<?php
const ERROR = "Oops, smth go wrong(";
if (!isset($_POST["name"])){
    return ERROR;
}
$config = require_once   __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";
include_once ($config["jsonManipulate"]);
$jsonHandle = new jsonManipulate($config["voteDB"], $_POST["name"]);
$jsonHandle->makeVote();
$data = $jsonHandle->getVotes();
if ($data === false){
    return ERROR;
}
$_SESSION["votes"] = $data;
header("location: {$config['votePage']}");
//$jsonString = file_get_contents($config['voteDB']);
//$data = json_decode($jsonString, true);
//$radioVal = $_POST["name"];
//foreach ($data['Users'] as &$value) {
//    if ($value["name"] === $_POST["name"]){
//        $value["votes"]++;
//        unset($value);
//        break;
//    }
//}
//file_put_contents($config['voteDB'], json_encode($data, JSON_PRETTY_PRINT));
//$_SESSION["votes"] = $data;
//header("location: {$config['votePage']}");




