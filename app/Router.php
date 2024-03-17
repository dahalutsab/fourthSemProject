<?php
declare(strict_types=1);

namespace App;

class Router
{

    private array $handler;
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function get(string $path, $handler, $middleware = null): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler, $middleware);
    }


    public function post(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler, $middleware = null): void
    {
        $this->handler[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestPath = parse_url($requestUri, PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach ($this->handler as $handler) {
            if ($handler['path'] === $requestPath && $handler['method'] === $method) {
                $callback = $handler['handler'];
                $middleware = $handler['middleware'];
            }
        }

        if(is_string($callback)) {
            $parts = explode('::', $callback);
            if (is_array($parts)) {
                $className = array_shift($parts);
                $handler = new $className();

                $method = array_shift($parts);
                $callback = [$handler, $method];
            }
        }

        if (!$callback) {
            header("HTTP/1.0 404 Not Found");
            if ($this->notFoundHandler) {
                call_user_func($this->notFoundHandler);
            }
            return;
        }

        if ($middleware && !call_user_func($middleware)) {
            // User is not authenticated, redirect them to the login page or show an error message
            header('Location: /login');
            exit;
        }


        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);

    }
}