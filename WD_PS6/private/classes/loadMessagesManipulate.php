<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loadMessagesManipulate extends dbManipulate
{

    private $lastMessages;

    public function __construct()
    {
        parent::__construct(dataDB);
    }

    public function mainFunction()
    {
        try {
            $this->checkUserTime();
            parent::loadJson();
            if (!$this->checkMessagesCount()){
                return;
            }
            echo json_encode(array($this->getMessages(), parent::getDBSize()));
        } catch (Exception $e) {
            pageRedirection::errorRedirection($e->getMessage());
        }
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

    private function getMessages()
    {
        $this->readMessages();
        return implode("\n", $this->lastMessages);
    }

    private function convertTextToHTML($value)
    {
        $value["time"] += intval($_POST["timeZone"]) * 60;
        $hour = $value["time"] / 3600 % 24;
        $minute = $value["time"] / 60 % 60;
        $second = $value["time"] % 60;
        $minute = strlen($minute) > 1 ? $minute : "0" . $minute;
        return $_SESSION["user_name"] === $value["name"] ?
            "<p style='text-align: right'>{$value["message"]} : <strong>You ({$value["name"]})</strong> [{$hour}:{$minute}:{$second}]</p>"
            : "<p>[{$hour}:{$minute}:{$second}] <strong>{$value["name"]}</strong>: {$value["message"]}</p>";
    }

    private function checkMessagesCount()
    {
        if (!isset($_POST["messageCount"]) || parent::getDBSize() === intval($_POST["messageCount"])) {
            return false;
        }
        return true;
    }

    private function checkUserTime()
    {
        if (!isset($_POST["timeZone"]) || !is_numeric($_POST["timeZone"])){
            throw new Exception("cant get user timezone");
        }
    }

}