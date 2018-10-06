<?php
if ($_GET['function'] == 'addNumbers') {
	addNumbers($_GET['first_value'], $_GET['second_value']);
	die();
}
if ($_GET['function'] == 'addRndNumbers') {
	addRndNumbers($_GET['first_value'], $_GET['second_value']);
	die();
}
if ($_GET['function'] == 'chrismassTree') {
	chrismassTree($_GET['first_value']);
	die();
}
if ($_GET['function'] == 'chessDesk') {
	chessDesk($_GET['first_value'], $_GET['second_value']);
	die();
}
if ($_GET['function'] == 'getSumm') {
	getSumm($_GET['first_value']);
	die();
}
if ($_GET['function'] == 'createArray') {
	createArray($_GET['first_value'], $_GET['second_value'], $_GET['third_value']);
	die();
}

function addNumbers($first_val, $second_val) {
	if ($first_val > $second_val){
		list($first_val, $second_val) = array($second_val, $first_val);
	}
	for ($i = $first_val ; $i <= $second_val; $i++){
		$count += $i;
	}
	echo $count;
}

function addRndNumbers($first_val, $second_val) {
	if ($first_val > $second_val){
		list($first_val, $second_val) = array($second_val, $first_val);
	}
	for ($i = $first_val ; $i <= $second_val; $i++){
		if (substr($i, -1) == 2 || substr($i, -1) == 3 || substr($i, -1) == 7 ){
			$count += $i;
		}
	}
	echo $count;
}

function chrismassTree($first_val) {
	for($i = 0; $i < $first_val; $i++){
		echo '</br>';
		for($j = 0; $j <= $i; $j++){
			echo "*";
		}
	}
}

function chessDesk($first_val, $second_val) {
	for($i = 0; $i < $first_val; $i++){
		echo '</br>';
		for($j = 0; $j < $second_val; $j++){
			echo (($j+$i)%2==0) ? '<div class="white"></div>' : '<div class="black"></div>';
			// if (($j+$i)%2==0){
			// 	echo '<div class="white"></div>';
			// } else {
			// 	echo '<div class="black"></div>';
			// }
		}
	}
}

function getSumm($first_val) {
	for($i = 0; $i < strlen($first_val); $i++){
		$count += $first_val{$i};
	}
	echo $count;
}

function createArray($first_val, $second_val, $third_val) {
	for($i = 0; $i < $first_val; $i++){
		$array[$i] = rand($second_val, $third_val);
		echo $array[$i].' ';
	}
	echo '</br>';
	$array = array_unique($array);
	echo '</br>';
	arsort($array);
	foreach  ($array as $value){
		echo $value.' ';
	}
}

?>
