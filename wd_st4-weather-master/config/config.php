<?php

define('JSON_DB', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'today.json');

return [
    'json_db' => JSON_DB,
    'database' => [
        'db_Host' => 'localhost',
        'db_User' => 'root',
        'db_Password' => '',
        'db_Name' => 'Weather',
        'charset' => 'utf8mb4'
    ]
];