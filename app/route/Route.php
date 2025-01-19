<?php
namespace App\Route;
use App\Exception\RouteException;

class Route
{
    private static $routes = [];

    public static function get(string $path, array $dispatcher): void
    {
        self::$routes['GET'][$path] = $dispatcher;
    }

    public static function post(string $path, array $dispatcher): void
    {
        self::$routes['POST'][$path] = $dispatcher;
    }

    public static function delete(string $path, array $dispatcher): void
    {
        self::$routes['DELETE'][$path] = $dispatcher;
    }

    public static function put(string $path, array $dispatcher): void
    {
        self::$routes['PUT'][$path] = $dispatcher;
    }

    public static function patch(string $path, array $dispatcher): void
    {
        self::$routes['PATCH'][$path] = $dispatcher;
    }

    public static function extractRoute(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return trim(str_replace('/app/index.php/', '', $uri));
    }

    public static function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function matchRoute(string $method, string $route): array
    {
        foreach (self::getRoutes($method) as $routePattern => $config) {
            $regex = preg_replace('/\{[a-zA-Z_]+\}/', '(\d+)', $routePattern);
            if (preg_match('#^' . $regex . '$#', $route, $matches)) {
                array_shift($matches);
                return [$config, $matches];
            }
        }

        throw new RouteException('Route not found!', 101);
    }

    public static function dispatch(array $routeConfig, string $method, array $routeParams): void
    {
        [$controllerName, $methodName] = $routeConfig;
        $controllerClass = 'App\\Http\\Controllers\\Api\\V1\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            throw new RouteException('Controller not found!', 102);
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $methodName)) {
            throw new RouteException('Method not found in controller!', 100);
        }

        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $input = self::getRequestBody();
            $controller->$methodName($input, ...$routeParams);
        } else {
            $controller->$methodName(...$routeParams);
        }
    }

    private static function getRoutes(string $method): array
    {
        return self::$routes[$method] ?? [];
    }

    public static function getRequestBody(): array
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RouteException('Invalid JSON input!', 103);
        }
        return $input ?: [];
    }
}
