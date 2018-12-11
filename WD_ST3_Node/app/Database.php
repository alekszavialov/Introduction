<?php

namespace app;

define('DB_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'database.json');

class Database
{

    private $database = null;

    public function __construct()
    {
        $database = null;
        if (!file_exists(DB_PATH)) {
            die();
        }
        $database = json_decode(file_get_contents(DB_PATH), true);
        if (json_last_error()) {
            $database = [];
        }
        $this->database = $database;
    }

    public function loadItems()
    {
        echo json_encode($this->database);
    }

    public function insertItem($positionX, $positionY, $message)
    {
        if (!is_writable(DB_PATH)) {
            die();
        }
        $data = [
            'id' => ((int)end($this->database)['id']) + 1,
            'positionX' => $positionX,
            'positionY' => $positionY,
            'message' => $message
        ];
        $this->database[] = $data;
        file_put_contents(DB_PATH, json_encode($this->database, JSON_PRETTY_PRINT), LOCK_EX);
        echo json_encode($data);
    }

    public function editItem($id = null, $positionX = '', $positionY = '', $message = '')
    {
        $blockId = array_search($id, array_column($this->database, 'id'));
        if (!is_writable(DB_PATH) || $blockId === false) {
            die();
        }
        $removedBlock = '';
        if (empty($message)) {
            $removedBlock = $this->database[$blockId];
            $removedBlock['active'] = false;
            unset($this->database[$blockId]);
            $this->database = array_values($this->database);
        } else {
            $this->database[$blockId]['positionX'] = $positionX;
            $this->database[$blockId]['positionY'] = $positionY;
            $this->database[$blockId]['message'] = $message;
        }
        file_put_contents(DB_PATH, json_encode($this->database, JSON_PRETTY_PRINT), LOCK_EX);
        echo empty($removedBlock) ? json_encode($this->database[$blockId]) : json_encode($removedBlock);
    }

}