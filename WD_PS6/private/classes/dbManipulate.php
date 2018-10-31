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
        } else if (count($data) === 3) {
            $this->saveToMessageTable($data);
        }
    }

    final public function findUser()
    {
        $sql_search = "SELECT USER_NAME, USER_PASSWORD FROM $this->tableName WHERE USER_NAME = '$_POST[userName]' 
LIMIT 1";
        $sql_result = mysqli_query($this->database, $sql_search);
        if ($sql_result) {
            $row = mysqli_fetch_assoc($sql_result);
        } else {
            throw new Exception('Bad query');
        }
        if (empty($row)) {
            mysqli_free_result($sql_result);
            return false;
        }
        if ($row['USER_PASSWORD'] !== $_POST["userPassword"]) {
            mysqli_free_result($sql_result);
            throw new Exception('Incorrect user name or password!');
        }
        mysqli_free_result($sql_result);
        return true;
    }

    final public function getLastMessages($lastMessageTime){
        $sql_search = "SELECT user_name, message, time FROM $this->tableName WHERE time >= $lastMessageTime";
        $sql_result = mysqli_query($this->database, $sql_search);
        $result = [];
        if ($sql_result) {
            $row = mysqli_fetch_assoc($sql_result);
            $result[] = $row;
        } else {
            throw new Exception('Bad query');
        }
        if (empty($row)) {
            mysqli_free_result($sql_result);
            return false;
        }
        while ($row = mysqli_fetch_assoc($sql_result)){
            $result[] = $row;
        }
        return $result;
    }


    final public function getDBSize()
    {
        $sql_result = mysqli_query($this->database, "SELECT max(id) FROM $this->tableName");
        if (!$sql_result) {
            die('Could not query:' . mysqli_error($this->database));
        }
        $result = mysqli_fetch_assoc($sql_result);
        return $result['max(id)'];
    }

    private function saveToUsersTable($data)
    {
        $query = "INSERT INTO $this->tableName (USER_NAME, USER_PASSWORD) VALUES ( '$data[name]', '$data[password]' )";
        mysqli_query($this->database, $query) or die($data);
    }

    private function saveToMessageTable($data)
    {
        $data["message"] = mysqli_real_escape_string($this->database, $data["message"]);
        $query = "INSERT INTO $this->tableName (user_name, message, time) VALUES ( '$data[name]', '$data[message]', '$data[time]' )";
        mysqli_query($this->database, $query) or die("INSERT INTO $this->tableName (user_name, message, time) VALUES ( ".$data." )");
    }

}