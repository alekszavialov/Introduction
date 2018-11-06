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
            $this->setClass();
        } catch (Exception $e) {
            pageRedirection::errorRedirection($e->getMessage());
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
        return $this->class = new $this->class();
    }

}