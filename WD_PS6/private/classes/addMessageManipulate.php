<?php

/** @noinspection PhpUnhandledExceptionInspection */

class addMessageManipulate extends dbManipulate
{

    public function __construct()
    {
        $this->checkMessage();
        parent::__construct(MESSAGES_DB);
    }

    public function mainFunction()
    {
        try {
            $messageText = htmlspecialchars($_POST['data'], ENT_QUOTES);
            $icons = [
                ':)' => "<span class='happy-smile'></span>",
                ':(' => "<span class='sad-smile'></span>"
            ];
            $messageText = strtr($messageText, $icons);
//            $message = [
//                'name' => $_SESSION['user_name'],
//                'message' => $messageText,
//                'time' => date_timestamp_get(date_create())
//            ];
            $rows = ['user_name', 'message', 'time'];
            $message = [$_SESSION['user_name'], $messageText, date_timestamp_get(date_create())];
            parent::insertIntoTable($rows, $message);
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