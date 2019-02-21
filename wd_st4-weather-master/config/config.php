<?php

define('PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);

return [
    'json' => PATH  . 'today.json',
    'api' => PATH  . 'api.json',
    'database' => [
        'dsn' => 'mysql:host=localhost;dbname=cities;charset=utf8',
        'user' => 'root',
        'password' => ''
    ]
];