<php include("task1.php"); ?>
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
   <form action="#" method="POST" class="form_task1">
    <input type="text" name="first_value" placeholder="Ener value">
    <input type="text" name="second_value" placeholder="Enter value">
    <input type="hidden" name="function" value="addNumbers" />
    <input type="submit" value="GetSumm" />   
    <p><?php echo $result1; ?></p>
   </form>		
  </div>
  <div class="task">
   <h2>
    Сумма от -1000 до 1000 которые заканчиваются на 2,3, и 7;
   </h2>
   <form action="task1.php" method="POST" class="form_task1">
    <input type="text" name="first_value" placeholder="Ener value">
    <input type="text" name="second_value" placeholder="Enter value">
    <input type="hidden" name="function" value="addRndNumbers" />
    <input type="submit" value="GetSumm" />   
    <p>0</p>
   </form>  
  </div>
  <div class="task">
   <h2>
    Елочка
   </h2>
   <form action="task1.php" method="POST" class="form_task1">
    <input type="text" name="first_value" placeholder="Ener value">
    <input type="hidden" name="function" value="chrismassTree" />
    <input type="submit" value="Build Tree" />   
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
    <input type="hidden" name="function" value="chessDesk" />
    <input type="submit" value="CreateDesk" />   
    <p class="desc">0</p>
   </form>  
  </div>
  <div class="task">
   <h2>
    Сумма чисел
   </h2>
   <form action="task1.php" method="POST" class="form_task1">
    <input type="text" name="first_value" placeholder="Ener value">
    <input type="hidden" name="function" value="getSumm" />
    <input type="submit" value="Get Summ of Numbers" />
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
    <input type="hidden" name="function" value="CreateArray" />
    <input type="submit" value="Create Array" /> 
    <p>0</p>
   </form> 
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