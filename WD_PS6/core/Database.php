<?php

namespace core;

class Database
{

    private $pdo;
    private static $instance;

    private function __construct()
    {
        $db = require ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'configDB.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        try {
            $this->pdo = new \PDO($db['dsn'], $db['user'], $db['password'], $options);
        } catch (\PDOException $e) {
            phpResponse::ajaxResponse(503, 'Service unavailable');
        }
    }

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    public function getConnection()
    {
        return $this->pdo;
    }

}
