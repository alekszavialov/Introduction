<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loginManipulate extends jsonDBManipulate
{

    public function __construct()
    {
        parent::__construct(USERSDB);
    }

    public function mainFunction()
    {
        try {
            $this->checkPostData();
            $this->loginUser();
            $_SESSION['user_name'] = $_POST['userName'];
            phpResponse::pageRedirection('', 'chat.php');
        } catch (Exception $e) {
            phpResponse::pageRedirection($e->getMessage(), 'index.php');
        }
    }

    private function checkPostData()
    {
        if (isset($_POST['logout']) && $_POST['logout'] === "true"){
            unset($_SESSION['user_name']);
            $_SESSION['error'] = "Log out!";
            phpResponse::ajaxResponse(200, 'index.php');
        }
        if (strlen($_POST['userName']) < MIN_NAME_LENGTH || strlen($_POST['userName']) > MAX_NAME_LENGTH
            || preg_match(LOGIN_REG, $_POST['userName'])) {
            throw new Exception('Name should exist 4 character at least or incorrect symbols!');
        }
        if (!isset($_POST['userPassword']) || strlen($_POST['userPassword']) < MIN_PASS_LENGTH ||
            strlen($_POST['userPassword']) > MAX_PASS_LENGTH ||
            preg_match(PASSWORD_REG, $_POST['userPassword'])) {
            throw new Exception('Password should exist 6 character at least or incorrect symbols!');
        }
    }

    private function loginUser()
    {
        if (!in_array($_POST['userName'], array_column(parent::getDB(), 'name'))) {
            $this->addNewUser();
            return;
        }
        foreach (parent::getDB() as &$value) {
            if ($value['name'] === $_POST['userName'] && $value['password'] !== $_POST['userPassword']) {
                throw new Exception('Incorrect password!');
            }
        }
    }

    private function addNewUser()
    {
        $userData = array(
            'name' => $_POST['userName'],
            'password' => $_POST['userPassword']
        );
        parent::saveJson($userData);
    }
}