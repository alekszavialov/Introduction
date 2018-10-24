<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loadMsgManipulate extends jsonDBManipulate
{

    private $lastMessages;
    private $currentUser;

    public function __construct($filePath, $currentUser)
    {
        parent::__construct($filePath);
        $this->currentUser = $currentUser;
    }

    public function loadMessages()
    {
        try {
            parent::loadJson();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getMessageCount()
    {
        return parent::getDBSize();
    }

    private function readMessages()
    {
        $hourInSeconds = 3600;
        $lastMessageTime = date_timestamp_get(date_create()) - $hourInSeconds;
        $this->lastMessages = array();
        foreach (array_reverse(parent::getDB()) as $key => &$value) {
            if ($value["time"] >= $lastMessageTime) {
                $this->lastMessages[] = $this->convertTextToHTML($value);
            }
        }
        $this->lastMessages = array_reverse($this->lastMessages);
    }

    public function getMessages()
    {
        $this->readMessages();
        return implode("\n", $this->lastMessages);
    }

    private function convertTextToHTML($value)
    {
        $hour = $value["time"] / 3600 % 24;
        $minute = $value["time"] / 60 % 60;
        $second = $value["time"] % 60;
        $minute = strlen($minute) > 1 ? $minute : "0" . $minute;
        return $this->currentUser === $value["name"] ?
            "<p style='text-align: right'>{$value["message"]} : <strong>You ({$value["name"]})</strong> [{$hour}:{$minute}:{$second}]</p>"
            : "<p>[{$hour}:{$minute}:{$second}] <strong>{$value["name"]}</strong>: {$value["message"]}</p>";
    }

}