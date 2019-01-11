<?php

namespace app\controllers;

use core\base\Controller;

class ChatController extends Controller
{

    public function indexAction()
    {
        if (!isset($_SESSION['user'])) {
            header('location: /main');
            die();
        }
        $this->setMeta('Chat');
    }

}
