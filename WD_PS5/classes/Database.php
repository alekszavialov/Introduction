<?php

namespace classes;

use Exception;

class Database
{

    private $database;
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->loadJson();
    }

    private function loadJson()
    {
        if (!file_exists($this->filePath)) {
           // file_put_contents($this->filePath, json_encode(array(), JSON_PRETTY_PRINT));
            throw new Exception('Cant find db');
        }
        if (!file_get_contents($this->filePath)){
            $this->database = [];
        } else {
            $this->database = json_decode(file_get_contents($this->filePath), true);
        }
        if (json_last_error()) {
            throw new Exception('Incorrect db type!');
        }
    }

    final public function saveJson($data)
    {
        if (!is_writable($this->filePath)) {
            throw new Exception('Cant write to file. Try again!');
        }
        $this->database[] = $data;
        file_put_contents($this->filePath, json_encode($this->database, JSON_PRETTY_PRINT), LOCK_EX);
    }

    final public function getDB()
    {
        return $this->database;
    }

    final public function getLastMessageID()
    {
        return count($this->database) > 0 ? end($this->database)['id'] : 0;
    }

}
