<?php
require_once '../vendor/autoload.php';
use App\Routes\Router;


$router = new Router();

$router->setRoutes([
    'GET' => [
        'cities' => ['CityController', 'index'],
    ],

    'POST' => [

    ]
]);

if (isset($_GET['route'])) {
    $uri = trim($_GET['route'], '/');
    
    $methode = $_SERVER['REQUEST_METHOD'];

    try {
        $route = $router->getRoute($methode, $uri);

        if ($route) {
            list($controllerName, $methodName) = $route;

            $controllerClass = 'App\\Controllers\\' . ucfirst($controllerName);

            $controller = new $controllerClass();

            if ($methodName) {
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                } else {
                    throw new Exception('Method not found in controller.');
                }
            } else {
                $controller->index();
            }
        } else {
            throw new Exception('Route not found.');
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
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
