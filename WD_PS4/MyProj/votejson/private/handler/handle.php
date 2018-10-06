<?php
session_start();
$radioVal = $_POST["name"];
//echo $radioVal;
$config = require_once  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "private" .
    DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";
$jsonString = file_get_contents($config['vote']);
$data = json_decode($jsonString, true);

//echo $radioVal === $test ? "true" : "Lesha ne popal!!!";
var_dump($radioVal);
var_dump($data);
$key = array_search($radioVal, $data);
var_dump($key);
$data['Users'][false+true+true+true]['votes']++;
file_put_contents($config['vote'], json_encode($data));

