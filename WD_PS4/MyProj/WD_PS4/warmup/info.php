<?php
$a = 1;
$b = &$a;
$a = 3;
$b = $a / 3;
echo `{$a} {$b}`;
