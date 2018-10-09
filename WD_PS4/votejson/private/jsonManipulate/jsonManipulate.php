<?php

class jsonManipulate
{
    private $database;
    private $filePath;
    private $userName;

    public function __construct($filePath, $userName)
    {
        $this->filePath = $filePath;
        $this->userName = $userName;
    }

    public function makeVote()
    {
        if (($this->database = $this->openAndReadJson()) !== FALSE) {
            $this->changeVote();
            $this->writeJson();
        }
    }

    private function openAndReadJson()
    {
        $jsonFile = file_get_contents($this->filePath);
        if ($jsonFile === false) {
            return false;
        }
        return json_decode($jsonFile, true);
    }

    private function changeVote()
    {
        foreach ($this->database['Users'] as &$value) {
            if ($value["name"] === $this->userName) {
                $value["votes"]++;
                unset($value);
                break;
            }
        }
    }

    private function writeJson()
    {
        file_put_contents($this->filePath, json_encode($this->database, JSON_PRETTY_PRINT));
    }

    public function getVotes()
    {
        return !isset($this->database) || $this->database !== false ? $this->database : false;
    }
}