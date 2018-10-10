<?php
const ERROR = "Oops, smth go wrong(";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"])){
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
}






