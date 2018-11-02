<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loginManipulate extends dbManipulate
{

    public function __construct()
    {
        parent::__construct(USERS_DB);
    }

    public function mainFunction()
    {
        try {
            $this->checkPostData();
            if (!parent::findUser()) {
                $this->addNewUser();
            }
            $_SESSION['user_name'] = $_POST['userName'];
            pageRedirection::chatPageRedirection();
        } catch (Exception $e) {
            pageRedirection::errorRedirection($e->getMessage());
        }
    }

    private function checkPostData()
    {
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


    private function addNewUser()
    {
        $rows = ['USER_NAME', 'USER_PASSWORD'];
        $userData = [$_POST['userName'], $_POST['userPassword']];
        parent::insertIntoTable($rows, $userData);
    }
}