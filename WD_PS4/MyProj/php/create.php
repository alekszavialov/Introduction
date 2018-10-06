<?php
$file = fopen("table.json", 'w') or die("не удалось создать файл");
$vote = array(
	"People" => "How many vote",
	"contents" => array(
		array(
			"Name" => "Alex",
			"Votes" => 0
			),
		array(
			"Name" => "Dima",
			"Votes" => 0	
			),
		array(
			"Name" => "Nox",
			"Votes" => 0	
			),
		array(
			"Name" => "Dmitriy",
			"Votes" => 0
			)
		),
	);
fwrite($file, json_encode($vote));
echo "string";
fclose($file);
?>