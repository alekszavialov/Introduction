<?php

return spl_autoload_register(function ($class) {
    $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . '.php';
    if (isset($file) && file_exists($file)) {
        require_once $file;
    }
});