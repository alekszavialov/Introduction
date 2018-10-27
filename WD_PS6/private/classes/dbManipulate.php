<?php

/** @noinspection PhpUnhandledExceptionInspection */

class dbManipulate
{

    private $database;
    private $tableName;

    public function __construct($tableName)
    {
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR
            . "database.php";
        $this->tableName = $tableName;
    }

    final public function loadDB()
    {
        $this->database = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
        if ($this->database->connect_error) {
            throw new Exception("Connection failed: " . $this->database->connect_error);
        }
    }

    final public function saveDataToDB($data)
    {
        $sql = "INSERT INTO {$this->tableName} (name, password) VALUES ({$data[0]}, {$data[1]})";
        if ($this->database->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->database->error;
        }

        $this->database->close();
    }
//
//    final public function getDB(){
//        return $this->database;
//    }
//
//    final public function getDBSize(){
//        return count($this->database);
//    }

}