<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 2/19/2019
 * Time: 11:54 PM
 */

namespace app;


class Json
{

    private $absoluteZero = 273.15;
    private $maxSunCloudsValue = 20;
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getData()
    {
        if (!file_exists($this->path) || !is_readable($this->path)) {
            echo json_encode('bad data!');
            die();
        }
        $data = json_decode(file_get_contents($this->path), true);
        if (!$data && json_last_error()) {
            echo json_encode($this->path);
            die();
        }
        $weatherData = [];
        foreach ($data['list'] as $key => $value) {
            $weatherData[$key]['date'] = $value['dt_txt'];
            $weatherData[$key]['temperature'] = $this->convertTemperature($value['main']['temp']);
            $weatherData[$key]['icon'] =
                $this->selectIcon($value['weather'][0]['main'], $value['clouds']['all']);
            if ($key == 7) {
                break;
            }
        }
        return $weatherData;
    }

    private function convertTemperature($temp)
    {
        return round(($temp - $this->absoluteZero));
    }

    private function selectIcon($icon, $cloudsAll)
    {
        switch ($icon) {
            case 'Clear':
                if ($cloudsAll < $this->maxSunCloudsValue) {
                    return 'sun';
                }
                return 'sky-1';
            case 'Clouds':
                return 'sky';
            case 'Rain':
                return 'rain';
            default:
                return 'flash';
        }
    }

}