<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loginManipulate
{
    private $database;
    private $filePath;
    private $userName;
    private $userPassword;

    public function __construct($filePath, $userName, $userPassword)
    {
        $this->filePath = $filePath;
        $this->userName = $userName;
        $this->userPassword = $userPassword;
    }

    public function submitLogin(){
        try{
            $this->loadJson();
            $this->loginUser();
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    private function loadJson()
    {
        if (!file_exists($this->filePath)) {
            $this->createNewUsersDB();
        }
        $this->database = json_decode(file_get_contents($this->filePath), true);
        if (json_last_error()){
            throw new Exception('Incorrect db type!');
        }
    }

    private function createNewUsersDB()
    {
        file_put_contents($this->filePath, json_encode (array(), JSON_PRETTY_PRINT));
    }

    private function loginUser()
    {
        if (!in_array($this->userName, array_column($this->database, "name"))) {
            $this->addNewUser();
            return;
        }
        foreach ($this->database as &$value) {
            if ($value["name"] === $this->userName) {
                if ($value["password"] !== $this->userPassword){
                    throw new Exception('Incorrect password!');
                }
            }
        }
    }

    private function addNewUser()
    {
        $userData = array(
            "name" => $this->userName,
            "password" => $this->userPassword
        );
        $this->database[] = $userData;
        file_put_contents($this->filePath, json_encode($this->database, JSON_PRETTY_PRINT));
    }
}