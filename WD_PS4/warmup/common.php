<?php
session_start();
const ERROR = 'Incorrect input data';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['function']) && function_exists($_POST['function'])) {
    $_POST['function']();
}
header('Location: index.php');


function addNumbers()
{
    $firstValue = -1000;
    $secondValue = 1000;
    $result = 0;
    if (isset($_POST['addRndNumbers'])) {
        $endValues = [2, 3, 7];
        for ($i = $firstValue; $i <= $secondValue; $i++) {
            if (in_array(abs($i % 10), $endValues)) {
                $result += $i;
            }
        }
        $_SESSION['addRndNumbers'] = $result;
    } else {
        for ($i = $firstValue; $i <= $secondValue; $i++) {
            $result += $i;
        }
        $_SESSION['addNumbers'] = $result;
    }
}

function chrismassTree()
{
    if (!is_numeric($_POST['stars_count'])) {
        $_SESSION['chrismassTree'] = ERROR;
        return;
    }
    $star = '*';
    $result = '';
    for ($i = 1; $i <= $_POST['stars_count']; $i++) {
        $result .= str_repeat($star, $i) . '</br>';
    }
    $_SESSION['chrismassTree'] = $result;
}

function chessBoard()
{
    if (!is_numeric($_POST['firstNumber']) || !is_numeric($_POST['secondNumber'])) {
        $_SESSION['chessDesk'] = ERROR;
        return;
    }
    $result = '';
    $newLine = '</br>';
    $boxWidth = 500;
    $boxHeight = 500;
    $boxSize = ($boxWidth / $_POST['firstNumber'] > $boxHeight / $_POST['secondNumber']) ?
        $boxHeight / $_POST['secondNumber'] :
        $boxWidth / $_POST['firstNumber'];
    $whiteBox = "<div class='white-box' style='width: {$boxSize}px; height: {$boxSize}px'></div>";
    $blackBox = "<div class='black-box' style='width: {$boxSize}px; height: {$boxSize}px'></div>";
    for ($col = 0; $col < $_POST['secondNumber']; $col++) {
        for ($row = 0; $row < $_POST['firstNumber']; $row++) {
            if ((($col + $row) % 2 == 0)) {
                $result .= $whiteBox;
            } else {
                $result .= $blackBox;
            }
        }
        $result .= $newLine;
    }
    $_SESSION['chessDesk'] = $result;
}

function getSumm()
{
    if (!is_numeric($_POST['value']) || $_POST['value'] < 0) {
        $_SESSION['getSumm'] = ERROR;
        return;
    }
    $value = str_split($_POST['value']);
    $_SESSION['getSumm'] = array_reduce($value, function ($all, $current) {
        return $all + $current;
    });
}

function createArray()
{
    for ($i = 0; $i < 100; $i++) {
        $result[] = random_int(1, 10);
    }
    $result = array_unique($result);
    sort($result);
    $_SESSION['createArray'] = join(',', array_reverse($result));
}

