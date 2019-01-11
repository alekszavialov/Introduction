<?php

namespace core\base;

class Controller
{

    private $route = [];
    private $meta;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->meta);
        $vObj->render();
    }

    protected function setMeta($meta)
    {
        $this->meta = [
            'title' => $meta
        ];
    }

}
