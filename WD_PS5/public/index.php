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
    <title>Login</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<section class="chat-body">
    <div class="container">
        <div class="chat">
            <h1>Easy chat</h1>
            <form action="../handler/handler.php" method="POST">
                <p>Enter your name</p>
                <input type="text" placeholder="John Doe" name="userName">
                <input type="hidden" name="className" value="loginManipulate">
                <p>Enter your password</p>
                <input type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="userPassword">
                <div class="login-button">
                    <button class="submit-button">Submit</button>
                </div>
            </form>
            <p>
                <?php
                if (isset($_SESSION['user_name'])) {
                    header('location: chat.php');
                }
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                } ?>
            </p>
        </div>
    </div>
</section>
</body>
</html>