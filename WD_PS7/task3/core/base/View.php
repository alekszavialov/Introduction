<?php

namespace core\base;

use core\TGateway;

class View
{

    use TGateway;

    private $route = [];
    private $meta = [
        'title' => ''
    ];


    public function __construct($route, $meta)
    {
        $this->route = $route;
        $this->meta = $meta;
    }

    public function render()
    {
        $file_view = APP . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $this->route['controller'] .
            DIRECTORY_SEPARATOR . 'index.php';
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            $this->badGateway();
        }
        $content = ob_get_clean();
        $meta = $this->meta;
        $file_layout = APP . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR .
            LAYOUT . '.php';
        if (is_file($file_layout)) {
            require $file_layout;
        } else {
            $this->badGateway();
        }
    }

}
