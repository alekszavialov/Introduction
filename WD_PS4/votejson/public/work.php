<?php
session_start();

$form_data = htmlspecialchars($_POST["data"]);

$restructed_data = $handle_that->divData();
$_SESSION['result'] = $restructed_data;

// echo "allWorks".$restructed_data;
header("location:index.php");


