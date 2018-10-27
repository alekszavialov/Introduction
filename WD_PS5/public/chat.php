<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    $_SESSION["error"] = "Oops!";
    header("location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<section class="chat-body">
    <div class="container">
        <div class="chat chat-area">
            <h1>Easy chat</h1>
            <form id="chat-Form" method="post" action="handler/handler.php">
                <div id="message-chat">
                </div>
                <div class="chat-send-msg">
                    <input id="message-value" type="text" name="data">
                    <input type="submit" value="Send">
                </div>
                <p class="errorArea"></p>
            </form>
        </div>
    </div>
</section>
<script src="libs/jquery/jquery-3.3.1.js"></script>
<script src="js/common.js"></script>
</body>
</html>