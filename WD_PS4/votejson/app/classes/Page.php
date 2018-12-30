<?php
/**
 * Created by PhpStorm.
 *  * User: Aleksandr Zavyalov
 * Date: 12/27/2018
 * Time: 11:58 PM
 */

namespace app\classes;

use core\Database;

class Page
{
    private $layout;
    private $database;
    private $data;
    private $title;

    public function __construct($layout)
    {
        $this->layout = $layout;
        try {
            $this->database = Database::instance();
        } catch (\Exception $e) {
            $this->errorRedirection();
        }
        if ($this->layout === 'index') {
            $this->title = 'Vote';
            $this->data = $this->getNames();
        } else if ($this->layout === 'votesResults') {
            $this->title = 'Votes results';
            $this->data = $this->getVotes();
        }
    }

    public function showView()
    {
        $file_view = APP . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . ucwords($this->layout) .
            DIRECTORY_SEPARATOR . 'index.php';
        ob_start();
        $title = $this->title;
        $data = $this->data;
        if (is_file($file_view)) {
            require_once $file_view;
        } else {
            $this->errorRedirection();
        }
        $content = ob_get_clean();
        $file_layout = APP . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR .
            'default.php';
        require_once $file_layout;
    }

    private function errorRedirection()
    {
        header('location: ../public/404.html');
        die();
    }

    private function getNames()
    {
        return array_column($this->database->getDatabase(), 'name');
    }

    private function getVotes()
    {
        $result[] = ['Name', 'Vote count'];
        foreach ($this->database->getDatabase() as $value) {
            $result[] = ["$value[name]", $value['votes']];
        }
        return json_encode($result);
    }

}
