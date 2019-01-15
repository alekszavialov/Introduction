<?php

namespace core;

class Router
{

    use TGateway;

    private $routes = [];
    private $route = [];

    public function add($regexp, $route = [])
    {
        $this->routes[$regexp] = $route;
    }

    private function matchRoute($url)
    {
        foreach ($this->routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                $route['controller'] = ucfirst($route['controller']);
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $this->route = $route;
                return true;
            }
        }
        return false;
    }

    public function dispatch($url)
    {
        $url = $this->removeQueryString($url);
        if ($this->matchRoute($url)) {
            $controller = 'app' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR .
                $this->route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $cObj = new $controller($this->route);
                $action = lcfirst($this->route['action'] . 'Action');
                if (method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
                } else {
                    $this->badGateway();
                }
            } else {
                $this->badGateway();
            }
        } else {
            $this->badGateway();
        }
    }

    private function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            }
        }
        return '';
    }

}
