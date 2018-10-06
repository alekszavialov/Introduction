<?php include("task.php"); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>PHP</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="normalize.css">
</head>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"
integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
crossorigin="anonymous"></script>
<script src="get.js"></script>
<body>
	<div class="container">
		<div class="task">
			<h2>
				Сумма от -1000 до 1000;</br>
			</h2>
			<input type="number" min="0" step="1" name="first_value_task1" id="first_value_task1" placeholder="Ener value">
			<input type="number" min="0" step="1" name="second_value_task1" id="second_value_task1" placeholder="Enter value">
			<input type="button" id="submit_task1" value="GetSumm" >
			<p id="text_task1">0</p>
		</div>
		<div class="task">
			<h2>
				Сумма от -1000 до 1000 которые заканчиваются на 2,3, и 7;
			</h2>
			<input type="number" min="0" step="1" name="first_value_task2" id="first_value_task2" placeholder="Ener value">
			<input type="number" min="0" step="1" name="second_value_task2" id="second_value_task2" placeholder="Enter value">
			<input type="button" id="submit_task2" value="GetSumm" >
			<p id="text_task2">0</p>
		</div>
		<div class="task">
			<h2>
				Елочка
			</h2>
			<input type="number" min="0" step="1" name="first_value_task3" id="first_value_task3" placeholder="Enter value">
			<input type="button" id="submit_task3" value="Build Tree" >
			<p id="text_task3">*</p>
		</div>
		<div class="task">
			<h2>
				Доска
			</h2>
			<input type="number" min="0" step="1" name="first_value_task4" id="first_value_task4" placeholder="Ener value">
			<input type="number" min="0" step="1" name="second_value_task4" id="second_value_task4" placeholder="Enter value">
			<input type="button" id="submit_task4" value="Create Desk" >
			<div class="desc" id="text_task4">
			</div>
		</div>
		<div class="task">
			<h2>
				Сумма чисел
			</h2>
			<input type="number" min="0" step="1" name="first_value_task5" id="first_value_task5" placeholder="Ener value">
			<input type="button" id="submit_task5" value="Get Summ" >
			<p id="text_task5">0</p>
		</div>
		<div class="task">
			<h2>
				Массив
			</h2>
			<input type="number" min="0" step="1" name="first_value_task6" id="first_value_task6" placeholder="Ener arrays size">
			<input type="number" min="0" step="1" name="second_value_task6" id="second_value_task6" placeholder="Enter value">
			<input type="number" min="0" step="1" name="third_value_task6" id="third_value_task6" placeholder="Enter value">
			<input type="button" id="submit_task6" value="Create Array" >
			<p id="text_task6">0</p>
		</div>
		<script>
			// $.getJSON('table.json', function(date) {
			// 	console.log(date);
			// })
			$.ajax({
				url: 'table.json',
				dataType : 'json',
				type : 'get',
				cache : false,
				success: function(data){
					$(data.contents).each(function(index, votes){
							console.log(votes.Name + ' ' + votes.Votes);
					});
					$(data).each(function(index, votes){
							console.log(votes.Name + ' ' + votes.Votes);
					});
				}
			});
		</script>
	</div>
</body>
</html>