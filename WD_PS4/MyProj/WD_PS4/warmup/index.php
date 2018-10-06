<?php include_once "common.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
</head>
<body>
<div class="container">
    <div class="task">
        <h2>
            Сумма от -1000 до 1000;
        </h2>
        <form action="" method="POST" class="form_task1">
            <input type="hidden" name="function" value="addNumbers"/>
            <input type="submit" value="GetSumm"/>
            <p><?php echo is_numeric($result) ? $result : "Run function" ?></p>
        </form>
    </div>
    <div class="task">
        <h2>
            Сумма от -1000 до 1000 которые заканчиваются на 2,3, и 7;
        </h2>
        <form action="#" method="POST" class="form_task1">
            <input type="hidden" name="function" value="addRndNumbers"/>
            <input type="submit" value="GetSumm"/>
            <p><?php echo is_numeric($result) ? $result : "Run function" ?></p>
        </form>
    </div>
    <div class="task">
        <h2>
            Елочка
        </h2>
        <form action="task1.php" method="POST" class="form_task1">
            <input type="text" name="first_value" placeholder="Ener value">
            <input type="hidden" name="function" value="chrismassTree"/>
            <input type="submit" value="Build Tree"/>
            <p>0</p>
        </form>
    </div>
    <div class="task">
        <h2>
            Доска
        </h2>
        <form action="task1.php" method="POST" class="form_task1">
            <input type="text" name="first_value" placeholder="Ener value">
            <input type="text" name="second_value" placeholder="Ener value">
            <input type="hidden" name="function" value="chessDesk"/>
            <input type="submit" value="CreateDesk"/>
            <p class="desc">0</p>
        </form>
    </div>
    <div class="task">
        <h2>
            Сумма чисел
        </h2>
        <form action="task1.php" method="POST" class="form_task1">
            <input type="text" name="first_value" placeholder="Ener value">
            <input type="hidden" name="function" value="getSumm"/>
            <input type="submit" value="Get Summ of Numbers"/>
            <p>0</p>
        </form>
    </div>
    <div class="task">
        <h2>
            Массив
        </h2>
        <form action="task1.php" method="POST" class="form_task1">
            <input type="text" name="first_value" placeholder="Ener value">
            <input type="text" name="second_value" placeholder="Ener value">
            <input type="text" name="third_value" placeholder="Ener value">
            <input type="hidden" name="function" value="CreateArray"/>
            <input type="submit" value="Create Array"/>
            <p>0</p>
        </form>
    </div>
</div>
</body>
</html>