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
            <form id="chat-Form" method="post" action="handler/handler.php">
                <div id="message-chat">

                </div>
                <div class="chat-send-msg">
                    <input id="message-value" type="text" name="message-value">
                    <input type="submit" value="Send">
                </div>
            </form>
        </div>
    </div>
</section>
<script src="libs/jquery/jquery-3.3.1.js"></script>
<script>
    loadMessage();
    $('#chat-Form').submit(function (e) {
        e.preventDefault();
        const m_method = $(this).attr('method');
        const m_action = $(this).attr('action');
        const m_data = 'userMessage=' + $('#message-value').val();
        $.ajax({
            type: m_method,
            url: m_action,
            data: m_data
        });
    });
    setInterval(loadMessage, 1000);
    function loadMessage() {
        const m_method = $('#chat-Form').attr('method');
        const m_action = $('#chat-Form').attr('action');
        const m_data = 'getMsg=true';
        $.ajax({
            type: m_method,
            url: m_action,
            data: m_data,
            success: function (result) {
                $("#message-chat").html(result);
            }
        });
        $("#message-chat").scrollTop($("#message-chat").prop("scrollHeight"));
    }
</script>
</body>
</html>