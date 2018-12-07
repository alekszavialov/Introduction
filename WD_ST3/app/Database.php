<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 12/7/2018
 * Time: 12:09 AM
 */

namespace app;


class Database
{

    private $database;

    public function __construct()
    {
        $database = null;
        if (file_exists(DB_PATH)) {
            $database = json_decode(file_get_contents(DB_PATH), true);
        }
        if (json_last_error()) {
            die();
        }
        $this->database = $database;
    }

    public function load()
    {
        echo json_encode($this->database);
    }

    public function insert($positionX, $positionY)
    {
        if (!is_writable(DB_PATH)) {
            die();
        }
        $data = [
            'id' => ((int)end($this->database)['id']) + 1,
            'positionX' => $positionX,
            'positionY' => $positionY,
            'message' => ''
        ];
        $this->database[] = $data;
        file_put_contents(DB_PATH, json_encode($this->database, JSON_PRETTY_PRINT), LOCK_EX);
        echo json_encode($data);
    }

    public function edit($id = null, $positionX = '', $positionY = '', $message = false)
    {
        if (!is_writable(DB_PATH)) {
            die();
        }
        $blockId = array_search($id, array_column($this->database, 'id'));
        if (!empty($positionX) && !empty($positionY)) {
            $this->database[$blockId]['positionX'] = $positionX;
            $this->database[$blockId]['positionY'] = $positionY;
        } else
        if ($message) {
            $this->database[$blockId]['message'] = $message;
            echo $this->database[$blockId]['message'] ? json_encode("true") :
                json_encode("false");
        }
       // file_put_contents(DB_PATH, json_encode($this->database, JSON_PRETTY_PRINT), LOCK_EX);
       // echo json_encode($this->database[$blockId]);
    }


}