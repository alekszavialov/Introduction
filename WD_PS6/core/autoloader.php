<?php

return spl_autoload_register(function ($class) {
    $file = ROOT . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . '.php';
    if ($file && file_exists($file)) {
        require_once $file;
    }
});
