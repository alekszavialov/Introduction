<?php

namespace app\models;

use core\base\Model;

class DashboardModel extends Model
{

    private $table;

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getUser($userName, $userPassword)
    {
        $user = $this->findOne($userName, 'name', $this->table);
        if (!$user) {
            $user = $this->addUser($userName, $userPassword);
        } else if (!password_verify($userPassword, $user['password'])) {
            return false;
        }
        return $user ? $user['name'] : false;
    }

    private function addUser($userName, $userPassword)
    {
        $cols = $this->implodeData(['name', 'password']);
        $data = [
            ':name' => $userName,
            ':password' => password_hash($userPassword, PASSWORD_BCRYPT)
        ];
        $query = "INSERT INTO $this->table ($cols ) VALUES (:name, :password)";
        if ($this->execute($query, $data)) {
            return $this->findOne($this->lastId($this->table), 'id', $this->table);
        }
        return false;
    }

    public function addMessage()
    {
        $messageText = htmlspecialchars($_POST['data'], ENT_QUOTES);
        $icons = [
            ':)' => "<span class='happy-smile'></span>",
            ':(' => "<span class='sad-smile'></span>"
        ];
        $messageText = strtr($messageText, $icons);
        $cols = $this->implodeData(['user_name', 'message', 'date']);
        $data = [
            ':user_name' => $_SESSION['user'],
            ':message' => $messageText,
            ':date' => date_timestamp_get(date_create())
        ];
        $query = "INSERT INTO $this->table ($cols ) VALUES (:user_name, :message, :date)";
        return $this->execute($query, $data);
    }

    public function loadMessage($messagesCount)
    {
        $data = [
            'lastMessageId' => $messagesCount
        ];
        $query = "SELECT * FROM $this->table WHERE date > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 HOUR)) AND 
                  id > :lastMessageId";
        $messages = $this->query($query, $data);
        if (!$messages) {
            return false;
        }
        $messages = array_map(function ($row) {
            $row['date'] = date('H:i:s', $row['date']);
            return $row;
        }, $messages);
        return [
            'messages' => $messages,
            'currentUser' => $_SESSION['user'],
            'messagesCount' => end($messages)['id']
        ];
    }

    public function logOut()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    private function implodeData($data)
    {
        return implode(",", $data);
    }

}
