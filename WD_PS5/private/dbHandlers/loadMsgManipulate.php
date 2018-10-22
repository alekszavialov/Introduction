<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loadMsgManipulate
{

    private $database;
    private $filePath;
    private $lastMessages;
    private $currentUser;

    public function __construct($filePath, $currentUser)
    {
        $this->filePath = $filePath;
        $this->currentUser = $currentUser;
    }

    public function loadMessages()
    {
        try {
            $this->loadJson();
            $this->readMessages();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function loadJson()
    {
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode(array(), JSON_PRETTY_PRINT));
        }
        $this->database = json_decode(file_get_contents($this->filePath), true);
        if (json_last_error()) {
            throw new Exception('Incorrect db type!');
        }
    }

    private function readMessages()
    {
        $hourInSeconds = 3600;
        $lastMessageTime = date_timestamp_get(date_create()) - $hourInSeconds;
        $sizeOfDB = count($this->database);
        $this->lastMessages = array();
        foreach (array_reverse($this->database) as $key => &$value) {
            if ($value["time"] <= $lastMessageTime) {
                break;
            }
            $this->lastMessages[] = $this->convertTextToHTML($value);
        }
        $this->lastMessages = array_reverse($this->lastMessages);
    }

    public function getMessages()
    {
        return implode("\n", $this->lastMessages);
    }

    public function getMessageCount()
    {
        if (isset($this->database)){
            $this->loadJson();
        }
        return count($this->database);
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