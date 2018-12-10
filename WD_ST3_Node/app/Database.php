<?php

namespace app;

define('DB_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'db.json');

class Database
{

    private $database = null;

    public function __construct()
    {
        $database = null;
        if (file_exists(DB_PATH)) {
            $database = json_decode(file_get_contents(DB_PATH), true);
        }
        if (json_last_error()) {
            die();
        }
        $this->database = $database;
    }

    public function loadItems()
    {
        echo json_encode($this->database);
    }

    public function insertItem($coordinateX, $coordinateY, $message)
    {

    }

    public function editItem($id = null, $positionX = '', $positionY = '', $message = '')
    {
    }

}