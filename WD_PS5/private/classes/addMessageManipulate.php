<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace manipulate;

use Exception;

class addMessageManipulate extends jsonDBManipulate
{

    public function __construct()
    {
        parent::__construct(DATADB);
    }

    public function mainFunction()
    {
        try {
            $this->checkUser();
            $this->checkMessage();
            $messageText = htmlspecialchars($_POST['data']);
            $message = [
                'id' => parent::getLastMessageID()+1,
                'name' => $_SESSION['user_name'],
                'message' => $messageText,
                'time' => date_timestamp_get(date_create())
            ];
            parent::saveJson($message);
            phpResponse::ajaxResponse(200);
        } catch (Exception $e) {
            phpResponse::ajaxResponse($e->getCode(), $e->getMessage());
        }
    }

    private function checkMessage()
    {
        $maxMessageLenght = 500;
        if (!isset($_POST['data']) || empty($_POST['data']) || strlen($_POST['data']) > $maxMessageLenght) {
            throw new Exception("Invorrect message!", 400);
        }
    }

    private function checkUser()
    {
        if (!isset($_SESSION['user_name'])) {
            $_SESSION['error'] = "Not logged!";
            throw new Exception("You need to login!", 401);
        }
    }


}