<?php

namespace app\controllers;

use core\base\Controller;

class MainController extends Controller
{

    public function indexAction()
    {
        if (isset($_SESSION['user'])) {
            header('location: /chat');
            die();
        }
        $this->setMeta('Login page');
    }

}
