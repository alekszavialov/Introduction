<?php

/** @noinspection SqlNoDataSourceInspection */

/** @noinspection PhpUnhandledExceptionInspection */

class dbManipulate
{

    private $database;
    private $tableName;

    public function __construct($tableName)
    {
        $this->database = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        if (mysqli_connect_error()) {
            throw new Exception('Connection failed');
        }
        $this->tableName = $tableName;
    }

    final public function addDataToTable($data)
    {
        if (count($data) === 2) {
            $this->saveToUsersTable($data);
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

    final public function getDBSize()
    {
        return count($this->database);
    }

    private function saveToUsersTable($data)
    {
        $query = "INSERT INTO $this->tableName (USER_NAME, USER_PASSWORD) VALUES ( '".$data['name']."' , '".$data['password']."')";
        mysqli_query($this->database, $query) or die("123");
    }

}