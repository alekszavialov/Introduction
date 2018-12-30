<?php

namespace core;

class Database
{

    protected $database;
    protected $databasePath;
    protected static $instance;

    private function __construct()
    {
        $this->databasePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' .
            DIRECTORY_SEPARATOR . 'usersDB.json';
        if (!file_exists($this->databasePath)) {
            throw new \Exception('Incorrect db path or db not exist!');
        }
        $this->database = json_decode(file_get_contents($this->databasePath), true);
        if (json_last_error() || empty($this->database)) {
            throw new \Exception('Incorrect db type!');
        }
    }

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function saveDatabase($database){
        if (!is_writable($this->databasePath) || empty($database)) {
            throw new \Exception('Cant write to file. Try again!');
        }
        $this->database = $database;
        file_put_contents($this->databasePath, json_encode($this->database, JSON_PRETTY_PRINT));
    }

    public function getDatabase()
    {
        return $this->database;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

}
