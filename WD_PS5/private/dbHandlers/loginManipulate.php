<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loginManipulate extends jsonDBManipulate
{

    private $userName;
    private $userPassword;

    public function __construct($filePath, $userName, $userPassword)
    {
        parent::__construct($filePath);
        $this->userName = $userName;
        $this->userPassword = $userPassword;
    }

    public function submitLogin(){
        try{
            parent::loadJson();
            $this->loginUser();
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    private function loginUser()
    {
        if (!in_array($this->userName, array_column(parent::getDB(), "name"))) {
            $this->addNewUser();
            return;
        }
        foreach (parent::getDB() as &$value) {
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
        parent::saveJson($userData);
    }
}