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

if (isset($_GET['route'])) {
    $uri = trim($_GET['route'], '/');
    
    $method = $_SERVER['REQUEST_METHOD'];

    try {
        $route = $router->getRoute($method, $uri);

        if ($route) {
            list($controllerName, $methodName) = $route;

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

}
















// require __DIR__."/../vendor/autoload.php";
// use App\Classes\Database;
// use App\Classes\City;
// use App\Classes\Weather;

// $db = Database::getConnection();
// $city = new City($db);
// $weather = new Weather($db);

// // Parse URL
// $route = $_GET['route'] ?? '';
// $method = $_SERVER['REQUEST_METHOD'];

// header('Content-Type: application/json');

// // Routes
// if ($route === 'cities' && $method === 'GET') {
//     echo json_encode($city->getCities());
// } elseif ($route === 'cities' && $method === 'POST') {
//     $data = json_decode(file_get_contents('php://input'), true);
//     $city->createCity($data['country'], $data['city_label']);
//     echo json_encode(['message' => 'City created']);
// } elseif (preg_match('/cities\/(\d+)\/weather/', $route, $matches) && $method === 'GET') {
//     $city_id = $matches[1];
//     echo json_encode($weather->getWeatherByCity($city_id));
// } elseif (preg_match('/cities\/(\d+)\/weather/', $route, $matches) && $method === 'POST') {
//     $data = json_decode(file_get_contents('php://input'), true);
//     $city_id = $matches[1];
//     $weather->createWeather($city_id, $data['temperature'], $data['weather'], $data['precipitation'], $data['humidity'], $data['wind']);
//     echo json_encode(['message' => 'Weather entry created']);
// } else {
//     echo json_encode(['message' => 'Route not found']);
// }
// ?>
