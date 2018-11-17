<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 11/17/2018
 * Time: 12:55 AM
 */

namespace votes;

use Exception;

class makeVote extends JsonManipulate
{

    private $voteName;

    public function __construct($voteName)
    {
        parent::__construct();
        $this->voteName = $voteName;
        $this->changeVote();
    }

    private function changeVote()
    {
        if (!in_array($this->voteName, array_column(parent::getDatabase(), 'name'))) {
            throw new Exception('Incorrect name or db!');
        }
        parent::setDatabase(array_map(function ($user) {
            if ($user['name'] === 'Alex') {
                $user['votes']++;
            };
            return $user;
        }, parent::getDatabase()));
        $this->writeJson();
    }

    private function writeJson()
    {
        if (!is_writable(VOTE_DB) || empty(parent::getDatabase())) {
            throw new Exception('Cant write to file. Try again!');
        }
        file_put_contents(VOTE_DB, json_encode(parent::getDatabase(), JSON_PRETTY_PRINT));
    }

}