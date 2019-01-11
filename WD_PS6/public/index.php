<?php

error_reporting(-1);

session_start();

use core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('CORE', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app');
define('SALT', '7PqivZ-Ija39JaszabP_gR');
define('LAYOUT', 'default');


//$pass_hash = password_hash("aaaaaaaaaaaaaaaa", PASSWORD_BCRYPT);
//
//echo $pass_hash;
//if (password_verify('aaaaaaaaaaaaaaaa', $pass_hash)) {
//    echo 'Password is valid!';
//} else {
//    echo 'Invalid password.';
//}
//
//die();

require ROOT . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'autoloader.php';

$router = new Router();

$router->add('^$', ['controller' => 'Main', 'action' => 'index']);
$router->add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

$router->dispatch($query);
