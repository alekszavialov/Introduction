<?php

namespace core\base;

use core\Database;

class Model
{

    private $connection;
    private $table;

    public function __construct()
    {
        $database = Database::instance();
        $this->connection = $database->getConnection();
    }

    protected function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql);
    }

    protected function findOne($data, $field, $table, $cols = '*')
    {
        $sql = "SELECT $cols FROM $table WHERE $field = ? LIMIT 1";
        $data = $this->query($sql, [$data]);
        if ($data) {
            return $data[0];
        }
        return false;
    }

    protected function lastId($table)
    {
        $sql = "SELECT max(id) FROM $table";
        return $this->query($sql)[0]['max(id)'];
    }

    protected function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $res = $stmt->execute($params);
        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }

    protected function execute($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($params);
    }

}
