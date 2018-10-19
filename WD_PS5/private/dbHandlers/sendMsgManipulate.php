<?php

/** @noinspection PhpUnhandledExceptionInspection */

class sendMsgManipulate
{
    private $database;
    private $filePath;
    private $userName;
    private $userMessage;

    public function __construct($filePath, $userName, $userMessage)
    {
        $this->filePath = $filePath;
        $this->userName = $userName;
        $this->userMessage = $userMessage;
    }

    public function writeMessage(){
       return $this->userMessage;
    }
}