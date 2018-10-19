<?php
session_start();
if (!isset($_SESSION["user_name"])) {
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
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<section class="chat-body">
    <div class="container">
        <div class="chat chat-area">
            <h1>Easy chat</h1>
            <div id="chat-Form">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                <div class="chat-send-msg">
                    <input id="message-value" type="text" name="message-value">
                    <button>Send</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="libs/jquery/jquery-3.3.1.js"></script>
<script>
    $('#chat-Form button').on('click', function (e) {
        e.preventDefault();
        var text = $("#message-value").val();
        $.ajax({
            url: 'handler/handler.php',
            type: 'POST',
            date: 'userName=123',
            success: function (result) {
                alert(result);
            }
        });
    });
</script>
</body>
</html>