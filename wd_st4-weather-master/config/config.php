<?php

define('PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);

return [
    'json' => PATH . 'today.json',
    'api' => [
        'locationKey' => '324291',
        'apiKey' => 'key',
        'locationSearchURL' => 'http://dataservice.accuweather.com/locations/v1/',
        'forecastSearchURL' => 'http://dataservice.accuweather.com/forecasts/v1/hourly/12hour/',
    ],
    'database' => [
        'dsn' => 'mysql:host=localhost;dbname=weather;charset=utf8',
        'user' => 'root',
        'password' => ''
    ]
];