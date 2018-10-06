<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <form action="data.php" method="post">
        <input type="text" name="data">
        <input type="hidden" value="first">
        <input type="submit">
    </form>
<?php
  if ($radioVal($_SESSION['result'])) {
      echo $_SESSION['result'];
  }
      ?>
</head>

<?php
session_destroy();
?>
<body>

</body>
</html>

<!--function addRndNumbers($first_val, $second_val)-->
<!--{-->
<!--$count = "";-->
<!--if ($first_val > $second_val) {-->
<!--list($first_val, $second_val) = array($second_val, $first_val);-->
<!--}-->
<!--for ($i = $first_val; $i <= $second_val; $i++) {-->
<!--if (substr($i, -1) == 2 || substr($i, -1) == 3 || substr($i, -1) == 7) {-->
<!--$count += $i;-->
<!--}-->
<!--}-->
<!--return $count;-->
<!--}-->
<!---->
<!--function chrismassTree($first_val)-->
<!--{-->
<!--$obj = "";-->
<!--for ($i = 0; $i < $first_val; $i++) {-->
<!--for ($j = 0; $j <= $i; $j++) {-->
<!--$obj .= "*";-->
<!--}-->
<!--$obj .= '</br>';-->
<!--}-->
<!--return $obj;-->
<!--}-->
<!---->
<!--function chessDesk($first_val, $second_val)-->
<!--{-->
<!--$obj = "";-->
<!--for ($i = 0; $i < $first_val; $i++) {-->
<!--$obj .= '</br>';-->
<!--for ($j = 0; $j < $second_val; $j++) {-->
<!--$obj .= (($j + $i) % 2 == 0) ? '<div class="white"></div>' : '<div class="black"></div>';-->
<!--}-->
<!--}-->
<!--return $obj;-->
<!--}-->
<!---->
<!--function getSumm($first_val)-->
<!--{-->
<!--$count = "";-->
<!--for ($i = 0; $i < strlen($first_val); $i++) {-->
<!--$count += $first_val{$i};-->
<!--}-->
<!--return $count;-->
<!--}-->
<!---->
<!--function createArray($first_val, $second_val, $third_val)-->
<!--{-->
<!--$obj = "";-->
<!--for ($i = 0; $i < $first_val; $i++) {-->
<!--$array[$i] = rand($second_val, $third_val);-->
<!--}-->
<!--$array = array_unique($array);-->
<!--arsort($array);-->
<!--foreach ($array as $value) {-->
<!--$obj .= $value . ' ';-->
<!--}-->
<!--return $obj;-->
<!--}-->