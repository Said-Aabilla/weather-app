<?php
require_once '../vendor/autoload.php';
use App\Routes\Router;
use App\Exception\RouteException;


$router = new Router();

$router->setRoutes([
    'GET' => [
        'cities' => ['CityController', 'index'],
    ],
    'POST' => [
        'cities' => ['CityController', 'create'],
    ]
]);

// Extract the route from REQUEST_URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = trim(str_replace('/app/index.php/', '', $uri));
// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

try {
    $routeConfig = $router->getRoute($method, $route);

    if ($routeConfig) {
        list($controllerName, $methodName) = $routeConfig;

        $controllerClass = 'App\\Http\\Controllers\\Api\\V1\\' . ucfirst($controllerName);
        $controller = new $controllerClass();

        if ($methodName) {
            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                throw new RouteException('Method not found in controller!', 100);
            }
        } else {
            $controller->index();
        }
    } else {
        throw new RouteException('Route not found!', 101);
    }
} catch (RouteException $e) {
    $e->response_error();
}
