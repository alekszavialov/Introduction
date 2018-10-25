<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loginManipulate extends jsonDBManipulate
{

    public function __construct()
    {
        parent::__construct(usersDB);
    }

    public function mainFunction(){
        try{
            $this->checkPostData();
            parent::loadJson();
            $this->loginUser();
            $_SESSION["user_name"] = $_POST["name"];
            pageRedirection::chatPageRedirection();
        } catch (Exception $e){
            pageRedirection::errorRedirection($e->getMessage());
        }
    }

    private function checkPostData()
    {
        if (strlen($_POST["name"]) < MIN_NAME_LENGTH || preg_match(LOGIN_REG, $_POST["name"])) {
            throw new Exception("Name should exist 4 character at least or incorrect symbols!");
        }
        if (!isset($_POST["password"]) || strlen($_POST["password"]) < MIN_PASS_LENGTH ||
            preg_match(PASSWORD_REG, $_POST["password"])) {
            throw new Exception("Password should exist 6 character at least or incorrect symbols!");
        }
    }

    private function loginUser()
    {
        if (!in_array($_POST["name"], array_column(parent::getDB(), "name"))) {
            $this->addNewUser();
            return;
        }
        foreach (parent::getDB() as &$value) {
            if ($value["name"] === $_POST["name"]) {
                if ($value["password"] !== $_POST["password"]){
                    throw new Exception('Incorrect password!');
                }
            }
        }
    }

    private function addNewUser()
    {
        $userData = array(
            "name" => $_POST["name"],
            "password" => $_POST["password"]
        );
        parent::saveJson($userData);
    }
}