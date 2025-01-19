<?php
namespace App;
use App\Exception\RouteException;
use App\Route\Route;

class App
{

    public static function run()
    {
        // Extract and parse the route
        $route = Route::extractRoute();
        $method = Route::getRequestMethod();
    
        // Match the route and retrieve route configuration
        [$routeConfig, $routeParams] = Route::matchRoute($method, $route);
    
        try {
            // Dispatch the route to the appropriate controller and method
            Route::dispatch($routeConfig, $method, $routeParams);
        } catch (RouteException $e) {
            $e->response_error();
        }
    }

    
}
