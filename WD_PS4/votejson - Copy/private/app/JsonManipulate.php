<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace votes;

use Exception;

class JsonManipulate
{
    private $database;

    public function __construct()
    {
        $this->openAndReadJson();
    }

    /**
     * @param mixed $database
     */
    public function setDatabase($database): void
    {
        $this->database = $database;
    }

    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }

    private function openAndReadJson()
    {
        if (!file_exists(VOTE_DB)) {
            throw new Exception('Incorrect db path or db not exist!');
        }
        $this->database = json_decode(file_get_contents(VOTE_DB), true);
        if (json_last_error()) {
            throw new Exception('Incorrect db type!');
        }
    }

    public function convertDbToCharts()
    {
        $result[] = ['Name', 'Vote count'];
        foreach ($this->database as &$value) {
            $result[] = ["$value[name]", $value['votes']];
        }
        return json_encode($result);
    }
}
