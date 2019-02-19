<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 2/19/2019
 * Time: 11:23 PM
 */

namespace app;


class WeatherController
{

    public function __construct($functionName)
    {
        return $this->selectController($functionName);
    }

    private function selectController($functionName){

    }

}