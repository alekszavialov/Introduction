<?php

namespace classes;

use core\phpResponse;
use Exception;

class LoadMessages extends Database
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
                'currentUser' => $_SESSION['user_name']]);
        } catch (Exception $e) {
            phpResponse::ajaxResponse($e->getCode(), $e->getMessage());
        }
    }

    private function readMessages()
    {
        $hourInSeconds = 3600;
        $lastMessageTime = date_timestamp_get(date_create()) - $hourInSeconds;
        $this->lastMessages = [];
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
        return $this->lastMessages;
    }

    private function convertTime($value)
    {
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
            throw new Exception('Incorret time!', 409);
        }
    }

    private function checkUser()
    {
        if (!isset($_SESSION['user_name'])) {
            $_SESSION['error'] = "Not logged!";
            throw new Exception("You need to login!", 401);
        }
    }

}
