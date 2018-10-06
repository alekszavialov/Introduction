<?php
session_start();
$config = require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "config" .
     DIRECTORY_SEPARATOR . "config.php";
require_once $config['handle'];

 $form_data = htmlspecialchars($_POST["data"]);

 $handle_that = new HandleData($form_data);
 $restructed_data = $handle_that->divData();
 $_SESSION['result'] = $restructed_data;

// echo "allWorks".$restructed_data;
 header("location:index.php");


