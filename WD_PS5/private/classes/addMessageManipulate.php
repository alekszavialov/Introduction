<?php

/** @noinspection PhpUnhandledExceptionInspection */

class addMessageManipulate extends jsonDBManipulate
{

    public function __construct()
    {
        $this->checkUser();
        $this->checkMessage();
        parent::__construct(DATADB);
    }

    public function mainFunction()
    {
        try {
            $messageText = htmlspecialchars($_POST['data']);
            $icons = array(
                ':)' => "<span class='happy-smile'></span>",
                ':(' => "<span class='sad-smile'></span>"
            );
            $messageText = strtr($messageText, $icons);
            $message = array(
                'name' => $_SESSION['user_name'],
                'message' => $messageText,
                'time' => date_timestamp_get(date_create())
            );
            parent::saveJson($message);
            phpResponse::ajaxResponse(200);
        } catch (Exception $e) {
            phpResponse::ajaxResponse($e->getCode(), $e->getMessage());
        }
    }

    private function checkMessage()
    {
        if (strlen($_POST['data']) === 0) {
            throw new Exception("Empty input value!", 409);
        }
    }

    private function checkUser()
    {
        if (!isset($_SESSION['user_name'])) {
            throw new Exception("You need to login!", 401);
        }
    }


}