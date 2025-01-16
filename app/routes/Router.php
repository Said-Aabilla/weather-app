<?php
namespace App\Routes;

class Router
{
    
    private $routes = [];

    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function getRoute($method, $uri)
    {
        $uri = trim($uri, '/');
        if (array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method])) {
            return $this->routes[$method][$uri];
        }

        return null;
    }
}
