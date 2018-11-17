<?php
/** @noinspection PhpIncludeInspection */
error_reporting(E_ALL);
ini_set('display_errors', 1);

define("ERROR", "Oops, smth go wrong(");

use votes\makeVote;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    errorRedirection(ERROR);
}
if (isset($_POST['name'])) {
  //  try {
        require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR
            . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $MakeVote = new MakeVote(VOTE_DB, $_POST['name']);
       // $_SESSION['votes'] = $jsonManipulate->convertDbToCharts();
      //  header('location: ../showVotes.php');
//    } catch (Exception $e) {
//        errorRedirection($e->getMessage());
//    }
} else {
    errorRedirection(ERROR);
}

function errorRedirection($errorMsg)
{
    $_SESSION['error'] = $errorMsg;
    header('location: ../index.php');
}

function __autoload($className)
{
    $className = explode('\\', $className);
    $className = end($className);
    if (file_exists(APP_DIR . "$className.php")){
        require_once(APP_DIR . "$className.php");
    } else {
        errorRedirection(ERROR);
    }
}
