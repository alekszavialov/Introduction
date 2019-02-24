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
        $sql = "SELECT timestamp AS 'date', temperature, clouds, rain_possibility FROM forecast ORDER BY id DESC LIMIT 6";
        $weather = $this->loadFromDB($sql);
        $weatherData = array_map(function ($row) {
            $row['icon'] = $this->selectIcon($row['clouds'], $row['rain_possibility']);
            unset($row['clouds']);
            unset($row['rain_possibility']);
            return $row;
        },
            array_reverse($weather));
        $sql = "SELECT name FROM cities LIMIT 1";
        $weatherData['city'] = $this->loadFromDB($sql)[0]['name'];
        return $weatherData;
    }

    private function loadFromDB($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();
        if (!$res) {
            echo(json_encode('error!'));
            die();
        }
        return $res;
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