<?php
session_start();
include_once "common.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
</head>
<style>
    .desc {
        margin-top: 10px;
        display: block;
    }
    .black-box, .white-box{
        display: inline-block;
        vertical-align: middle;
    }
    .black-box {
        background: #FFFF00;
    }
    .white-box{
        background: #FF0000;
    }
</style>
<body>
<div class="container">
    <div class="task">
        <h2>
            Сумма от -1000 до 1000;
        </h2>
        <form action="" method="POST" class="form_task1">
            <input type="hidden" name="function" value="addNumbers"/>
            <input type="submit" value="GetSumm"/>
            <p><?php echo isset($_SESSION["addNumbers"]) ? $_SESSION["addNumbers"] : "Run function" ?></p>
        </form>
    </div>
    <div class="task">
        <h2>
            Сумма от -1000 до 1000 которые заканчиваются на 2,3, и 7;
        </h2>
        <form action="#" method="POST" class="form_task1">
            <input type="hidden" name="function" value="addRndNumbers"/>
            <input type="submit" value="GetSumm"/>
            <p><?php echo isset($_SESSION["addRndNumbers"]) ? $_SESSION["addRndNumbers"] : "Run function" ?></p>
        </form>
    </div>
    <div class="task">
        <h2>
            Елочка
        </h2>
        <form action="" method="POST" class="form_task1">
            <input type="number" name="stars_count" min="1" max="50" step="1">
            <input type="hidden" name="function" value="chrismassTree"/>
            <input type="submit" value="Build Tree"/>
            <p><?php echo isset($_SESSION["chrismassTree"]) ? $_SESSION["chrismassTree"] : "Run function" ?></p>
        </form>
    </div>
    <div class="task board">
        <h2>
            Доска
        </h2>
        <form action="" method="POST" class="form_task1">
            <input type="number" name="firstNumber" min="1" max="12">
            <input type="number" name="secondNumber" min="1" max="12">
            <input type="hidden" name="function" value="chessDesk"/>
            <input type="submit" value="CreateDesk"/>
            <div class="desc"><?php echo isset($_SESSION["chessDesk"]) ? $_SESSION["chessDesk"] : "Run function" ?></div>
        </form>
    </div>
    <div class="task">
        <h2>
            Сумма чисел
        </h2>
        <form action="" method="POST" class="form_task1">
            <input type="number" name="value" min="1" max="100000">
            <input type="hidden" name="function" value="getSumm"/>
            <input type="submit" value="Get Summ of Numbers"/>
            <p><?php echo isset($_SESSION["getSumm"]) ? $_SESSION["getSumm"] : "Run function" ?></p>
        </form>
    </div>
    <div class="task">
        <h2>
            Массив
        </h2>
        <form action="" method="POST" class="form_task1">
            <input type="hidden" name="function" value="createArray"/>
            <input type="submit" value="Create Array"/>
            <p><?php echo isset($_SESSION["createArray"]) ? $_SESSION["createArray"] : "Run function" ?></p>
        </form>
    </div>
</div>
</body>
</html>
<?php
session_unset();
session_destroy();
?>