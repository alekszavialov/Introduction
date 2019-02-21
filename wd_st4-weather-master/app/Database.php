<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 2/21/2019
 * Time: 10:59 PM
 */

namespace app;


class Database
{

    private $pdo;

    public function __construct($path)
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        try {
            $this->pdo = new \PDO($path['dsn'], $path['user'], $path['password'], $options);
        } catch (\PDOException $e) {
            die();
        }
    }

    public function getData()
    {
        $sql = 'SELECT * FROM cities, forecast';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();
        if (!$res) {
            echo(json_encode('error!'));
        }
        $weatherData = [];
        foreach ($res as $key => $value) {
            $weatherData[$key]['date'] = $value['timestamp'];
            $weatherData[$key]['temperature'] = $value['temperature'];
            $weatherData[$key]['icon'] = $this->selectIcon($value['clouds'], $value['rain_possibility']);
        }
        return $weatherData;
    }

    private function selectIcon($rainValue, $cloudsValue)
    {
        if ($rainValue >= 0.8) {
            return 'rain';
        }
        if ($cloudsValue > 15) {
            return 'sky';
        }
        return 'sun';
    }

}