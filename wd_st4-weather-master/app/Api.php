<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 2/21/2019
 * Time: 11:13 PM
 */

namespace app;


class Api
{

    private $data;
    private $farengeitZero = 32;
    private $farengeitInerval = 1.8;
    private $sun = ['Sunny', 'Mostly Sunny', 'Partly Sunny', 'Intermittent Clouds', 'Hazy Sunshine', 'Mostly Cloudy',
        'Hot', 'Clear', 'Mostly Clear'];
    private $cloud = ['Cloudy', 'Dreary (Overcast)', 'Fog', 'Ice', 'Freezing Rain', 'Cold', 'Windy', 'Partly Cloudy',
        'Intermittent Clouds', 'Hazy Moonlight', 'Mostly Cloudy', 'Mostly Cloudy w/ Flurries', 'Mostly Cloudy w/ Snow'];
    private $rain = ['Showers', 'Mostly Cloudy w/ Showers', 'Rain', 'Snow', 'Mostly Cloudy w/ Snow', 'Sleet',
        'Rain and Snow', 'Partly Cloudy w/ Showers', 'Mostly Cloudy w/ Showers', 'Partly Cloudy w/ T-Storms',
        'Mostly Cloudy w/ T-Storms'];
    private $flash = ['T-Storms', 'Mostly Cloudy w/ T-Storms', 'Partly Sunny w/ T-Storms'];
    private $sky = ['Mostly Cloudy w/ Flurries', 'Partly Sunny w/ Flurries', 'Partly Sunny w/ T-Storms'];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {

        $city = $this->loadData($this->data['locationSearchURL']);
        $data = $this->loadData($this->data['forecastSearchURL']);
        $weatherData['city'] = $city['LocalizedName'];
        foreach (array_slice($data, 0, 6) as $key => $value) {
            $weatherData[$key]['date'] = $value['DateTime'];
            $weatherData[$key]['temperature'] = $this->convertTemperature($value['Temperature']['Value']);
            $weatherData[$key]['icon'] = $this->selectIcon($value['IconPhrase']);
        }
        return $weatherData;
    }

    private function convertTemperature($temp)
    {
        return round(($temp - $this->farengeitZero) / $this->farengeitInerval);
    }

    private function selectIcon($icon)
    {
        if (in_array($icon, $this->sun)) {
            return 'sun';
        }
        if (in_array($icon, $this->cloud)) {
            return 'sky';
        }
        if (in_array($icon, $this->rain)) {
            return 'rain';
        }
        if (in_array($icon, $this->flash)) {
            return 'flash';
        }
        if (in_array($icon, $this->sky)) {
            return 'sky-1';
        }
        return 'sun';
    }

    private function loadData($url)
    {
        $data = json_decode(
            @file_get_contents($url . $this->data['locationKey'] . '?apikey=' . $this->data['apiKey']), true
        );
        if (!$data && json_last_error()) {
            echo json_encode($this->path);
            die();
        }
        return $data;
    }

}