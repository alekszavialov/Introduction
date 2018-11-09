<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Created by PhpStorm.
 * User: dslife
 * Date: 10/25/2018
 * Time: 10:15 PM
 */

namespace manipulate;

use Exception;

class checkValuesAndSetManipulateClass
{

    private $class;

    public function __construct()
    {
        $this->findFunctionByIncomeData();
    }

    private function findFunctionByIncomeData()
    {
        try {
            $this->setClass();
        } catch (Exception $e) {
            phpResponse::pageRedirection($e->getMessage(), "index.php");
        }
    }

    private function setClass()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['className'])) {
            $this->class = $_POST['className'];
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['className'])){
            $this->class = $_GET['className'];
        } else {
            throw new Exception('Cannot found class!');
        }
    }

    public function getClass()
    {
        $className = "manipulate\\" . $this->class;
        return $this->class = new $className;
    }

}