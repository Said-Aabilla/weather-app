<?php
require_once '../vendor/autoload.php';
use App\Routes\Router;
use App\Exception\RouteException;


$router = new Router();

$router->setRoutes([
    'GET' => [
        'cities' => ['CityController', 'index'],
        'cities/{city_id}/weather' => ['WeatherController', 'index'],
    ],
    'POST' => [
        'cities' => ['CityController', 'create'],
        'cities/{city_id}/weather' => ['WeatherController', 'create'],
    ],
    'PUT' => [
        'cities/{id}' => ['CityController', 'update'],
    ],
    'DELETE' => [
        'cities/{id}' => ['CityController', 'delete'],
        'cities/{city_id}/weather/{weather_id}' => ['WeatherController', 'delete'],
    ]
]);

// Extract the route from REQUEST_URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = trim(str_replace('/app/index.php/', '', $uri));

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

$routeParams = [];
$routeConfig = null;

foreach ($router->getRoutes($method) as $routePattern => $config) {
    // Convert route pattern to regex (cities/{id} => cities/(\d+))
    $regex = preg_replace('/\{[a-zA-Z_]+\}/', '(\d+)', $routePattern);
    if (preg_match('#^' . $regex . '$#', $route, $matches)) {
        array_shift($matches); // Remove the full match
        $routeParams = $matches;
        $routeConfig = $config;
        break;
    }
}


try {
    if (!$routeConfig) {
        throw new RouteException('Route not found!', 101);
    }

    list($controllerName, $methodName) = $routeConfig;

    $controllerClass = 'App\\Http\\Controllers\\Api\\V1\\' . ucfirst($controllerName);
    if (!class_exists($controllerClass)) {
        throw new RouteException('Controller not found!', 102);
    }

    $controller = new $controllerClass();

    if (method_exists($controller, $methodName)) {
        if($method == 'POST' || $method == 'PUT' ){
            $input = json_decode(file_get_contents('php://input'), true);
            $controller->$methodName($input,...$routeParams);
        }else{
            $controller->$methodName(...$routeParams);
        }
    } else {
        throw new RouteException('Method not found in controller!', 100);
    }
} catch (RouteException $e) {
    $e->response_error();
}
