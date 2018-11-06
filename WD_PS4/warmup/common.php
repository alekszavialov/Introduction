<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
const ERROR = "Incorrect input data";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['function'])) {
    switch ($_POST['function']) {
        case 'addNumbers':
            $_SESSION["addNumbers"] = addNumbers(false);
            break;
        case 'addRndNumbers':
            $_SESSION["addRndNumbers"] = addNumbers(true);
            break;
        case 'chrismassTree':
            if (!is_numeric($_POST['stars_count'])) {
                $_SESSION["addRndNumbers"] = ERROR;
                break;
            }
            $_SESSION["chrismassTree"] = chrismassTree($_POST['stars_count']);
            break;
        case 'chessDesk':
            if (!is_numeric($_POST['secondNumber']) || !is_numeric($_POST['secondNumber'])) {
                $_SESSION["chessDesk"] = ERROR;
                break;
            }
            $_SESSION["chessDesk"] = chessBoard($_POST['firstNumber'], $_POST['secondNumber']);
            break;
        case 'getSumm':
            if (!is_numeric($_POST['value']) || $_POST['value'] < 0) {
                $_SESSION["getSumm"] = ERROR;
                break;
            }
            $_SESSION["getSumm"] = getSumm($_POST['value']);
            break;
        case 'createArray':
            $_SESSION["createArray"] = implode(",", createArray());
    }
}
header("Location: index.php");


function addNumbers($rndNumbers)
{
    $firstValue = -1000;
    $secondValue = 1000;
    $result = 0;
    if ($firstValue > $secondValue) {
        [$firstValue, $secondValue] = [$secondValue, $firstValue];
    }
    if ($rndNumbers) {
        $endValues = [2, 3, 7];
        for ($i = $firstValue; $i <= $secondValue; $i++) {
            if (in_array(abs($i % 10), $endValues)) {
                $result += $i;
            }
        }
    } else {
        for ($i = $firstValue; $i <= $secondValue; $i++) {
            $result += $i;
        }
    }
    return $result;
}

function chrismassTree($value)
{
    $star = "*";
    $result = "";
    for ($i = 1; $i <= $value; $i++) {
        $result .= str_repeat($star, $i) . "</br>";
    }
    return $result;
}

function chessBoard($firstValue, $secondValue)
{
    $result = "";
    $newLine = "</br>";
    $boxWidth = 500;
    $boxHeight = 500;
    $boxSize = ($boxWidth / $firstValue > $boxHeight / $secondValue) ? $boxHeight / $secondValue :
        $boxWidth / $firstValue;
    $whiteBox = "<div class='white-box' style='width: {$boxSize}px; height: {$boxSize}px'></div>";
    $blackBox = "<div class='black-box' style='width: {$boxSize}px; height: {$boxSize}px'></div>";
    for ($col = 0; $col < $secondValue; $col++) {
        for ($row = 0; $row < $firstValue; $row++) {
            if ((($col + $row) % 2 == 0)) {
                $result .= $whiteBox;
            } else {
                $result .= $blackBox;
            }
        }
        $result .= $newLine;
    }
    return $result;
}

function getSumm($value)
{
    $value = str_split($value);
    return array_reduce($value, function ($all, $current) {
        return $all + $current;
    });
}

function createArray()
{
    $result[] = '';
    for ($i = 0; $i < 100; $i++) {
        $result[] = random_int(1, 10);
    }
    $result = array_unique($result);
    sort($result);
    return array_reverse($result);
}

