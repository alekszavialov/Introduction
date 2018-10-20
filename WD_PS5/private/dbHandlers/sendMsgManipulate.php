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
       try{
           $this->loadJson();
           $this->addMessage();
       } catch (Exception $e){
           throw new Exception($e->getMessage());
       }
    }

    private function loadJson()
    {
        if (!file_exists($this->filePath)) {
            $this->createNewMsgDB();
        }
        $this->database = json_decode(file_get_contents($this->filePath), true);
        if (json_last_error()){
            throw new Exception('Incorrect db type!');
        }
    }

    private function createNewMsgDB()
    {
        file_put_contents($this->filePath, json_encode (array(), JSON_PRETTY_PRINT));
    }

    private function addMessage()
    {
        $message = array(
            "name" => $this->userName,
            "message" => $this->userMessage,
            "time" => date_timestamp_get(date_create())
        );
        $this->database[] = $message;
        file_put_contents($this->filePath, json_encode($this->database, JSON_PRETTY_PRINT));
    }

    /**
     * @return mixed
     */
    public function getUserMessage()
    {
        return $this->userMessage;
    }
}