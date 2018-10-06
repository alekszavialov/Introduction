<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//switch( $_POST['function'] )
//{
//    case 'addNumbers':
//    $first_val = $_POST['first_value'];
//    $second_val = $_POST['second_value'];
//    if ( (!empty($first_val) && !empty($second_val)) && (is_numeric($first_val) && is_numeric($second_val)) )
//    {
//
//       $result1 = addNumbers($first_val, $second_val);
//   } else {
//       $result1 = "Empty value!";
//   }
//   break;
//
//   // case 'addRndNumbers':
//   // $first_val = $_POST['first_value'];
//   // $second_val = $_POST['second_value'];
//   // if ( (!empty($first_val) && !empty($second_val)) && (is_numeric($first_val) && is_numeric($second_val)) )
//   // {
//   //     echo addRndNumbers($first_val, $second_val);
//   // } else {
//   //     echo "Empty value!";
//   // }
//   // break;
//
//   // case 'chrismassTree':
//   // $first_val = $_POST['first_value'];
//   // if ( !empty($first_val)  && is_numeric($first_val) )
//   // {
//   //     echo chrismassTree($first_val);
//   // } else {
//   //     echo "Empty value!";
//   // }
//   // break;
//
//   // case 'chessDesk':
//   // $first_val = $_POST['first_value'];
//   // $second_val = $_POST['second_value'];
//   // if ( (!empty($first_val) && !empty($second_val)) && (is_numeric($first_val) && is_numeric($second_val)) )
//   // {
//   //     echo chessDesk($first_val, $second_val);
//   // } else {
//   //     echo "Empty value!";
//   // }
//   // break;
//
//   // case 'getSumm':
//   // $first_val = $_POST['first_value'];
//   // if ( !empty($first_val)  && is_numeric($first_val) )
//   // {
//   //     echo getSumm($first_val);
//   // } else {
//   //     echo "Empty value!";
//   // }
//   // break;
//
//   // case 'CreateArray':
//   // $first_val = $_POST['first_value'];
//   // $second_val = $_POST['second_value'];
//   // $third_val = $_POST['third_value'];
//   // if ( (!empty($first_val) && !empty($second_val) && !empty($third_val))
//   //  && (is_numeric($first_val) && is_numeric($second_val) && is_numeric($third_val)))
//   // {
//   //     echo createArray($first_val, $second_val, $third_val);
//   // } else {
//   //     echo "Empty value!";
//   // }
//   // break;
//
//   default:
//   die ( 'Неизвестное действие.' );
//}
//
//function addNumbers($first_val, $second_val) {
//    $count = "";
//    if ($first_val > $second_val){
//        list($first_val, $second_val) = array($second_val, $first_val);
//    }
//    for ($i = $first_val ; $i <= $second_val; $i++){
//        $count += $i;
//    }
//    return echo $count;
//}
//
//function addRndNumbers($first_val, $second_val) {
//    $count = "";
//    if ($first_val > $second_val){
//        list($first_val, $second_val) = array($second_val, $first_val);
//    }
//    for ($i = $first_val ; $i <= $second_val; $i++){
//        if (substr($i, -1) == 2 || substr($i, -1) == 3 || substr($i, -1) == 7 ){
//            $count += $i;
//        }
//    }
//    return $count;
//}
//
//function chrismassTree($first_val) {
//    $obj = "";
//    for($i = 0; $i < $first_val; $i++){
//        for($j = 0; $j <= $i; $j++){
//            $obj .= "*";
//        }
//        $obj .= '</br>';
//    }
//    return $obj;
//}
//
//function chessDesk($first_val, $second_val) {
//    $obj = "";
//    for($i = 0; $i < $first_val; $i++){
//        $obj .= '</br>';
//        for($j = 0; $j < $second_val; $j++){
//            $obj .= (($j+$i)%2==0) ? '<div class="white"></div>' : '<div class="black"></div>';
//        }
//    }
//    return $obj;
//}
//
//function getSumm($first_val) {
//    $count = "";
//    for($i = 0; $i < strlen($first_val); $i++){
//        $count += $first_val{$i};
//    }
//    return $count;
//}
//
//function createArray($first_val, $second_val, $third_val) {
//    $obj = "";
//    for($i = 0; $i < $first_val; $i++){
//        $array[$i] = rand($second_val, $third_val);
//    }
//    $array = array_unique($array);
//    arsort($array);
//    foreach  ($array as $value){
//        $obj .= $value.' ';
//    }
//    return $obj;
//}
//?>