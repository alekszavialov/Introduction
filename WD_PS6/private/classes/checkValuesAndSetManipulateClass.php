<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Created by PhpStorm.
 * User: dslife
 * Date: 10/25/2018
 * Time: 10:15 PM
 */
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
            $this->checkMethod();
            $this->setClass();
        } catch (Exception $e) {
            pageRedirection::errorRedirection($e->getMessage());
        }
    }

    private function setClass()
    {
        if (!isset($_POST['className'])) {
            throw new Exception('Cannot found class!');
        }
        $this->class = $_POST['className'];

    }

    public function getClass()
    {
        return $this->class = new $this->class();
    }

    private function checkMethod()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('POST!');
        }
    }

}