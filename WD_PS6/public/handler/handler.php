<?php

/** @noinspection SqlNoDataSourceInspection */
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpIncludeInspection */

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'dbConfig.php';

$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}

//$query = "SELECT * FROM users";
//$result = mysqli_query($link, $query);
//if ($result) {
//    //pageRedirection::errorRedirection(mysqli_num_rows($result));
//    mysqli_free_result($result);
//}

//$sql = "INSERT INTO users (user_name, user_password) VALUES ('John', '123456')";
//
//if (mysqli_query($link, $sql)) {
//    pageRedirection::errorRedirection("New record created successfully");
//} else {
//    echo "Error: " . $sql . "<br>" . mysqli_error($link);
//}

$sql_search = "SELECT USER_NAME, USER_PASSWORD FROM users WHERE USER_PASSWORD = '" . $_POST['userPassword'] . "'";
$test = mysqli_query($link, $sql_search);
$row = mysqli_fetch_all($test, MYSQLI_ASSOC);
//if ($row && $row['USER_PASSWORD'] === '123456') {
//    while ($row = mysqli_fetch_row($test)) {
//        printf ("%s (%s)\n", $row[0], $row[1]);
//    }
//    echo "1";
//    printf("%s (%s)\n", $row['USER_NAME'], $row['USER_PASSWORD']);
//} else {
//    $test1 = "INSERT INTO users (USER_NAME, USER_PASSWORD) VALUES ('".$_POST['userName']."',
// '".$_POST['userPassword']."')";
//    mysqli_query($link, $test1);
//    printf("ok");
//}


foreach ($row as $column => $value) {
    //echo $column . " = " . $value;
    printf("%s (%s)\n", $value['USER_NAME'], $value['USER_PASSWORD']);
    echo "<br />";
}

mysqli_free_result($test);


mysqli_close($link);

//$checkValuesAndSetFunction = new checkValuesAndSetManipulateClass();
//$manipulateClass = $checkValuesAndSetFunction->getClass();
//$manipulateClass->mainFunction();

function __autoload($className)
{
    if (file_exists(CLASSES_DIR . "$className.php")) {
        require_once(CLASSES_DIR . "$className.php");
    } else {
        pageRedirection::errorRedirection(ERROR);
    }
}










