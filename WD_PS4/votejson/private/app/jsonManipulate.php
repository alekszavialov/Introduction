<?php /** @noinspection PhpUnhandledExceptionInspection */

class jsonManipulate
{
    private $database;
    private $filePath;
    private $userName;

    public function __construct($filePath, $userName)
    {
        $this->filePath = $filePath;
        $this->userName = $userName;
        $this->makeVote();
    }

    private function makeVote()
    {
        $this->openAndReadJson();
        $this->changeVote();
        $this->writeJson();
    }

    private function openAndReadJson()
    {
        if (!file_exists($this->filePath)) {
            throw new Exception('Incorrect db path or db not exist!');
        }
        $this->database = json_decode(file_get_contents($this->filePath), true);
        if (json_last_error()) {
            throw new Exception('Incorrect db type!');
        }
    }

    private function changeVote()
    {
        if (!in_array($this->userName, array_column($this->database, "name"))) {
            throw new Exception('Incorrect name or db!');
        }
        foreach ($this->database as &$value) {
            if ($value["name"] === $this->userName) {
                $value["votes"]++;
                break;
            }
        }
    }

    private function writeJson()
    {
        if (!is_writable($this->filePath) || empty($this->database)) {
            throw new Exception('Cant write to file. Try again!');
        }
        file_put_contents($this->filePath, json_encode($this->database, JSON_PRETTY_PRINT));
    }

    public function convertDbToCharts()
    {
        $result[] = ["Name", "Vote count"];
        foreach ($this->database as &$value) {
            $result[] = ["{$value['name']}", $value['votes']];
        }
        return json_encode($result);
    }
}