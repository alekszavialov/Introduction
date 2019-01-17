<?php

session_start();

use core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('CORE', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app');
define('LOG_FILE', ROOT . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'logs.txt');
define('LAYOUT', 'default');

require ROOT . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'autoloader.php';

$router = new Router();

$router->add('^$', ['controller' => 'Main', 'action' => 'index']);
$router->add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

$router->dispatch($query);
