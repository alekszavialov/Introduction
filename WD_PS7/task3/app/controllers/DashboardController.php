<?php

namespace app\controllers;

use app\models\DashboardModel;
use core\PhpResponse;

class DashboardController
{

    private $model;

    public function __construct()
    {
        if (!$this->isAjax()) {
            header('location: /main');
            die();
        }
        $this->model = new DashboardModel();
    }

    public function logInAction()
    {
        if (!$this->isCorrectData()) {
            PhpResponse::ajaxResponse(400,
                'Incorrect length, characters of username or password!',
                [__CLASS__, __FUNCTION__]);
        }
        $this->model->setTable('user');
        $user = $this->model->getUser($_POST['user'], $_POST['password']);
        if (!$user) {
            PhpResponse::ajaxResponse(401, 'Incorrect password!', [__CLASS__, __FUNCTION__]);
        }
        $_SESSION['user'] = $user;
        PhpResponse::ajaxResponse(200, 'chat', [__CLASS__, __FUNCTION__]);
    }

    public function logOutAction()
    {
        $this->model->setTable('user');
        $this->model->logOut();
        PhpResponse::ajaxResponse(200, 'main', [__CLASS__, __FUNCTION__]);
    }

    public function addMessageAction()
    {
        if (!$this->isUser()) {
            PhpResponse::ajaxResponse(401, 'You need to login!', [__CLASS__, __FUNCTION__]);
        }
        if (!$this->isCorrectMessage()) {
            PhpResponse::ajaxResponse(400, 'Incorrect message!', [__CLASS__, __FUNCTION__]);
        }
        $this->model->setTable('message');
        $data = $this->model->addMessage();
        if ($data) {
            PhpResponse::ajaxResponse(200, $data, [__CLASS__, __FUNCTION__]);
        }
        PhpResponse::ajaxResponse(503, 'Service unavailable', [__CLASS__, __FUNCTION__]);
    }

    public function loadMessageAction()
    {
        if (!$this->isUser()) {
            PhpResponse::ajaxResponse(401, 'You need to login!', [__CLASS__, __FUNCTION__]);
        }
        $this->model->setTable('message');
        $data = $this->model->loadMessage($_GET['messagesCount']);
        if (!$data) {
            PhpResponse::ajaxResponse(202, '', [__CLASS__, __FUNCTION__]);
        }
        PhpResponse::ajaxResponse(200, $data, [__CLASS__, __FUNCTION__]);
    }

    private function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    private function isCorrectMessage()
    {
        $maxMessageLength = 500;
        return isset($_POST['data']) &&
            trim($_POST['data']) &&
            strlen($_POST['data']) <= $maxMessageLength;
    }

    private function isUser()
    {
        return isset($_SESSION['user']);
    }

    private function isCorrectData()
    {
        $minNameLength = 4;
        $maxNameLength = 20;
        $minPassLength = 6;
        $maxPassLength = 16;
        $loginReg = '([^\w\d-_])';
        $passwordReg = '([^\w\d])';
        if (!isset($_POST['user']) ||
            strlen($_POST['user']) < $minNameLength ||
            strlen($_POST['user']) > $maxNameLength ||
            preg_match($loginReg, $_POST['user'])) {
            return false;
        }
        if (!isset($_POST['password']) ||
            strlen($_POST['password']) < $minPassLength ||
            strlen($_POST['password']) > $maxPassLength ||
            preg_match($passwordReg, $_POST['password'])) {
            return false;
        }
        return true;
    }

}
