<?php

/** @noinspection PhpUnhandledExceptionInspection */

class addMessageManipulate extends jsonDBManipulate
{

    public function __construct()
    {
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
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function checkMessage()
    {
        if (strlen($_POST['data']) === 0) {
            echo "Empty message!";
            die();
        }
    }


}