<?php

define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app');

use app\classes\Page;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'autoloader.php';

$page = new Page('votesResults');

$page->showView();
