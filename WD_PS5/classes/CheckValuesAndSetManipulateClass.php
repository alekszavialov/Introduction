<?php

namespace classes;

use core\phpResponse;
use Exception;

class CheckValuesAndSetManipulateClass
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
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['className'])) {
            $this->class = $_GET['className'];
        } else {
            throw new Exception('Cannot find class!');
        }
    }

    public function getClass()
    {
        $className = __NAMESPACE__ . '\\' . $this->class;
        return $this->class = new $className;
    }

}
