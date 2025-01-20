<?php
namespace App;
use App\Exception\RouteException;
use Exception;
use App\Route\Route;

class App
{

    public static function run()
    {
        try {
            // Extract and parse the route
            $route = Route::extractRoute();
            $method = Route::getRequestMethod();
        
            // Match the route and retrieve route configuration
            [$routeConfig, $routeParams] = Route::matchRoute($method, $route);
    
        } catch (RouteException  $e) {
            $e->response_error();
        }
       
        try {
            // Dispatch the route to the appropriate controller and method
            Route::dispatch($routeConfig, $method, $routeParams);
        } catch (Exception $e) {
            $e->response_error();
        }
    }

    
}
