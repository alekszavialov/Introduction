<?php
session_start();
include_once("../private/handler/handle.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <label for="name1"><input type="radio" id="name1" name="name" value
        ="Ivan">Ivan</label>
    <label for="name2"><input type="radio" id="name2" name="name" value
        ="Alex">Alex</label>
    <label for="name3"><input type="radio" id="name3" name="name" value
        ="Nikolai">Nikolai</label>
    <label for="name4"><input type="radio" id="name4" name="name" value
        ="Dora">Dora</label>
    <input type="submit">
</form>
</body>
</html>