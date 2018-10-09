<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
const ERROR = "Incorrect input data";
if (isset($_POST['function'])) {
    switch ($_POST['function']) {
        case 'addNumbers':
            if (!is_numeric($_POST['secondNumber']) || !is_numeric($_POST['secondNumber'])) {
                return $_SESSION["addNumbers"] = ERROR;
            }
            return $_SESSION["addNumbers"] = addNumbers($_POST['firstNumber'], $_POST['secondNumber']);
        case 'addRndNumbers':
            if (!is_numeric($_POST['secondNumber']) || !is_numeric($_POST['secondNumber'])) {
                return $_SESSION["addRndNumbers"] = ERROR;
            }
            return $_SESSION["addRndNumbers"] = addRndNumbers($_POST['firstNumber'], $_POST['secondNumber']);
        case 'chrismassTree':
            if (!is_numeric($_POST['stars_count'])) {
                return $_SESSION["addRndNumbers"] = ERROR;
            }
            return $_SESSION["chrismassTree"] = chrismassTree($_POST['stars_count']);
        case 'chessDesk':
            if (!is_numeric($_POST['secondNumber']) || !is_numeric($_POST['secondNumber'])) {
                return $_SESSION["chessDesk"] = ERROR;
            }
            return $_SESSION["chessDesk"] = chessBoard($_POST['firstNumber'], $_POST['secondNumber']);
        case 'getSumm':
            if (!is_numeric($_POST['value']) || $_POST['value'] < 0) {
                return $_SESSION["getSumm"] = ERROR;
            }
            return $_SESSION["getSumm"] = getSumm($_POST['value']);
        case 'createArray':
            return $_SESSION["createArray"] = implode(",", createArray());
    }
}


function addNumbers($firstValue, $secondValue)
{
    $result = 0;
    if ($firstValue > $secondValue) {
        [$firstValue, $secondValue] = [$secondValue, $firstValue];
    }
    for ($i = $firstValue; $i <= $secondValue; $i++) {
        $result += $i;
    }
    return $result;
}

function addRndNumbers($firstValue, $secondValue)
{
    $result = 0;
    $endValues = [2, 3, 7];
    if ($firstValue > $secondValue) {
        [$firstValue, $secondValue] = [$secondValue, $firstValue];
    }
    for ($i = $firstValue; $i <= $secondValue; $i++) {
        if (in_array(abs($i % 10), $endValues)) {
            $result += $i;
        }
    }
    return $result;
}

function chrismassTree($value)
{
    $result = "";
    for ($i = 1; $i <= $value; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            $result .= "*";
        }
        $result .= "</br>";
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
    for ($i = 0; $i < $secondValue; $i++) {
        for ($j = 0; $j < $firstValue; $j++) {
            if ((($i + $j) % 2 == 0)) {
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

