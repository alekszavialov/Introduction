<?php

use core\Database;

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['name'])) {
    header('location: ../public/404.html');
} else {

    require_once 'Database.php';

    try {
        $database = Database::instance();
        if (!in_array($_POST['name'], array_column($database->getDatabase(), 'name'))) {
            throw new \Exception('Incorrect name or db!');
        }
        $database->saveDatabase((array_map(function ($user) {
            if ($user['name'] === $_POST['name']) {
                $user['votes']++;
            };
            return $user;
        }, $database->getDatabase())));
        header('location: ../public/votesResults.php');
    } catch (\Exception $e) {
        header('location: ../public/404.html');
    }
}

