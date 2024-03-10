<?php

namespace App;

class Router
{
    private array $routes = [];

    public function __construct(array $routes = []) // Optional: Inject routes from Routes.php
    {
        $this->routes = $routes;
    }

    public function addRoute(string $path, string $controllerMethod): void
    {
        $this->routes[$path] = $controllerMethod;
    }

    public function match(): ?Route
    {
        $requestedUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        foreach ($this->routes as $route => $controllerMethod) {
            $pattern = preg_replace('/\{(.*?)\}/', '([^/]+)', $route); // Allow route parameters with curly braces
            if (preg_match("#^$pattern$#", $requestedUrl, $matches)) {
                // Extract parameters from matches (if any)
                $params = [];
                if (isset($matches[1])) {
                    $params = explode('/', $matches[1]);
                }
                return new Route($route, $controllerMethod, $params);
            }
        }
        return null;
    }

    public function run(): void
    {
        $matchedRoute = $this->match();

        if ($matchedRoute) {
            $controller =  $matchedRoute->getController();
            $method = $matchedRoute->getMethod();
            $params = $matchedRoute->getParams();
            $controller->$method(...$params); // Call the controller method with parameters
        } else {
            echo "404 - Page not found";
        }
    }
}


