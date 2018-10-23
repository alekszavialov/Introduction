<?php
session_start();
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
        <div class="chat">
            <h1>Easy chat</h1>
            <form action="handler/handler.php" method="POST">
                <p>Enter your name</p>
                <input type="text" placeholder="John Doe" name="name">
                <p>Enter your password</p>
                <input type="password" placeholder="*****" name="password">
                <button class="chat-button">Submit</button>
            </form>
            <p>
                <?php
                if ($_SESSION["error"]) {
                    echo $_SESSION["error"];
                    session_destroy();
                } else {
                    echo $_SESSION["votes"];
                    session_destroy();
                } ?>
            </p>
        </div>
    </div>
</section>
</body>
</html>