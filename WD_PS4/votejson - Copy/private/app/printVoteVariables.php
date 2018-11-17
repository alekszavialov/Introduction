<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 11/17/2018
 * Time: 1:50 AM
 */

namespace votes;

class printVoteVariables extends JsonManipulate
{

    public function __construct()
    {
        parent::__construct();
        $this->printVoteVariables();
    }

    private function printVoteVariables()
    {
        foreach (parent::getDatabase() as $key => $value) {
            $result[] = "<div><label for='$key'><input type='radio' id='$key' name='name' value
            ='$value[name]'>'$value[name]'</label></div>";
        }
        $result[] = "<input type='submit' value='Make vote'>";
        print_f($result);
    }

}