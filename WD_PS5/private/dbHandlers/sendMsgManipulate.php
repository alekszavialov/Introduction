<?php

/** @noinspection PhpUnhandledExceptionInspection */

class sendMsgManipulate extends jsonDBManipulate
{

    private $userName;
    private $userMessage;

    public function __construct($filePath, $userName, $userMessage)
    {
        parent::__construct($filePath);
        $this->userName = $userName;
        $this->userMessage = $userMessage;
    }

    public function writeMessage(){
       try{
           parent::loadJson();
           $this->addMessage();
       } catch (Exception $e){
           throw new Exception($e->getMessage());
       }
    }

    private function addMessage()
    {
        $message = array(
            "name" => $this->userName,
            "message" => $this->userMessage,
            "time" => date_timestamp_get(date_create())
        );
        parent::saveJson($message);
    }

    /**
     * @return mixed
     */
    public function getUserMessage()
    {
        return $this->userMessage;
    }
}