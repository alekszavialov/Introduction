<?php

/** @noinspection PhpUnhandledExceptionInspection */

class addMessageManipulate extends dbManipulate
{

    public function __construct()
    {
        $this->checkMessage();
        parent::__construct(dataDB);
    }

    public function mainFunction()
    {
        try {
            parent::loadDB();
            $this->addMessage();
        } catch (Exception $e) {
            pageRedirection::errorRedirection($e->getMessage());
        }
    }

    private function addMessage()
    {
        $messageText = htmlspecialchars($_POST["userMessage"]);
        $icons = array(
            ':)' => '<span class="happy-smile"></span>',
            ':(' => '<span class="sad-smile"></span>'
        );
        $messageText = strtr($messageText, $icons);
       // $messageText = str_replace($messageText, ":)", "<span class='happy-smile'> </span>");
        //  $messageText = str_replace($messageText, ":(", "<span class='sad-smile'> </span>");
        $message = array(
            "name" => $_SESSION["user_name"],
            "message" => $messageText,
            "time" => date_timestamp_get(date_create())
        );
        parent::saveJson($message);
    }

    private function checkMessage()
    {
        if (strlen($_POST["userMessage"]) === 0) {
            throw new Exception("Empty message!");
        }
    }
}