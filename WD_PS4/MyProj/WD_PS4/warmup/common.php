<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$result = '';
if (isset($_POST['function'])) {
    switch ($_POST['function']) {
        case 'addNumbers':
            $result = new addNumbers();
            $result = $result->getResult();
            $result = '';
            break;
        case 'addRndNumbers':
            $result = new addRndNumbers();
            $result = $result->getResult();
            $result = '';
            break;
    }
}

class addNumbers
{
    private $first_val = -1000;
    private $second_val = 1000;
    private $result;

    public function __construct()
    {
        $this->result = 0;
        $this->result = $this->calcNumbers($this->first_val, $this->second_val);
    }

    public function getResult()
    {
        return $this->result;
    }

    private function calcNumbers($first_val, $second_val)
    {
        $count = 0;
        for ($i = $first_val; $i <= $second_val; $i++) {
            $count += $i;
        }
        return $count;
    }
}

class addRndNumbers
{
    private $first_val = -1000;
    private $second_val = 1000;
    private $result;

    public function __construct()
    {
        $this->result = 0;
        $this->result = $this->calcNumbers($this->first_val, $this->second_val);
    }

    public function getResult()
    {
        return $this->result;
    }

    private function calcNumbers($first_val, $second_val)
    {
        $count = 0;
        for ($i = $first_val; $i <= $second_val; $i++) {
            if (substr($i, -1) == 2 || substr($i, -1) == 3 || substr($i, -1) == 7) {
                $count += $i;
            }
        }
        return $count;
    }
}