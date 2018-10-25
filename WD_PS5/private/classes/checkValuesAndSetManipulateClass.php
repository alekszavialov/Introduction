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

    public function findFunctionByIncomeData()
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
        if (isset($_POST["name"])) {
            $this->class = "loginManipulate";
            return;
        }
        if (isset($_POST["userMessage"])) {
            $this->class = "addMessageManipulate";
            return;
        }
        if (isset($_POST["getMsg"])) {
            $this->class = "loadMessagesManipulate";
            return;
        }
        throw new Exception("Val!");

    }

    public function getFunction()
    {
        try {
            if (isset($this->class)) {
                return $this->class;
            }
            throw new Exception("function!");
        } catch (Exception $e) {
            pageRedirection::errorRedirection($e->getMessage());
        }
    }

    private function checkMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            throw new Exception("POST!");
        }
    }

}