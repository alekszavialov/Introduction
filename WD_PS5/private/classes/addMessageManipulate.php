<?php

/** @noinspection PhpUnhandledExceptionInspection */

class addMessageManipulate extends jsonDBManipulate
{

    public function __construct()
    {
        $this->checkMessage();
        parent::__construct(dataDB);
    }

    public function mainFunction(){
       try{
           parent::loadJson();
           $this->addMessage();
       } catch (Exception $e){
           pageRedirection::errorRedirection($e->getMessage());
       }
    }

    private function addMessage()
    {
        $message = array(
            "name" => $_SESSION["user_name"],
            "message" => $_POST["userMessage"],
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