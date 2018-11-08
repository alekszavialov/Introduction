<?php

/** @noinspection PhpUnhandledExceptionInspection */

class loadMessagesManipulate extends jsonDBManipulate
{

    private $lastMessages;

    public function __construct()
    {
        parent::__construct(DATADB);
    }

    public function mainFunction()
    {
        try {
            $this->checkUser();
            $this->checkUserTime();
            if (!$this->checkMessagesCount()) {
                phpResponse::ajaxResponse(202);
            }
            phpResponse::ajaxResponse(200, ['messages' => $this->getMessages(),
                'messagesCount' => parent::getLastMessageID(), 'currentUser' => $_SESSION['user_name']]);
        } catch (Exception $e) {
            die();
        }
    }

    private function readMessages()
    {
        $hourInSeconds = 3600;
        $lastMessageTime = date_timestamp_get(date_create()) - $hourInSeconds;
        $this->lastMessages = array();
        foreach (array_reverse(parent::getDB()) as $key => &$value) {
            if ($value['time'] >= $lastMessageTime) {
                $value['time'] = $this->convertTime($value);
                $this->lastMessages[] = $value;
            }
        }
        $this->lastMessages = array_reverse($this->lastMessages);
    }

    private function getMessages()
    {
        $this->readMessages();
        return json_encode($this->lastMessages);
    }

    private function convertTime($value)
    {
//        $value['time'] += intval($_GET['timeZone']) * 60;
//        $hour = $value['time'] / 3600 % 24;
//        $minute = $value['time'] / 60 % 60;
//        $second = $value['time'] % 60;
//        $hour = strlen($hour) > 1 ? $hour : '0' . $hour;
//        $minute = strlen($minute) > 1 ? $minute : '0' . $minute;
//        $second = strlen($second) > 1 ? $second : '0' . $second;
//        return $_SESSION['user_name'] === $value['name'] ?
//            "<p style='text-align: right'>{$value["message"]} : <strong>You ({$value["name"]})</strong> [{$hour}:{$minute}:{$second}]</p>"
//            : "<p>[{$hour}:{$minute}:{$second}] <strong>{$value["name"]}</strong>: {$value["message"]}</p>";

        $value['time'] += intval($_GET['timeZone']) * 60;
        $hour = $value['time'] / 3600 % 24;
        $minute = $value['time'] / 60 % 60;
        $second = $value['time'] % 60;
        $hour = strlen($hour) > 1 ? $hour : '0' . $hour;
        return "[{$hour}:{$minute}:{$second}]";
    }

    private function checkMessagesCount()
    {
        if (!isset($_GET['messageCount']) || parent::getLastMessageID() === intval($_GET['messageCount'])) {
            return false;
        }
        return true;
    }

    private function checkUserTime()
    {
        if (!isset($_GET['timeZone']) || !is_numeric($_GET['timeZone'])) {
            throw new Exception('Incorret time!');
        }
    }

    private function checkUser()
    {
        if (!isset($_SESSION['user_name'])) {
            throw new Exception('Empty user!');
        }
    }

}