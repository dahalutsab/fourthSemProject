<?php
declare(strict_types=1);

namespace App;

use App\Interceptor\Interceptor;

class Router
{
    private array $handlers;
    private $notFoundHandler;
    private Interceptor $interceptor;

    public function __construct(Interceptor $interceptor)
    {
        $this->handlers = [];
        $this->interceptor = $interceptor;
    }

    public function get(string $path, array $handler, array $roles = [], string $redirectUrl = null): void
    {
        $this->addHandler('GET', $path, $handler, $roles, $redirectUrl);
    }

    public function post(string $path, array $handler): void
    {
        $this->addHandler('POST', $path, $handler);
    }

    public function addNotFoundHandler(callable $handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, array $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestPath = parse_url($requestUri, PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;

        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $handler['method'] === $method) {
                $callback = $handler['handler'];
                break;
            }
        }

        if (!$callback) {
            header("HTTP/1.0 404 Not Found");
            if ($this->notFoundHandler) {
                call_user_func($this->notFoundHandler);
            }
            return;
        }


        // Check interceptor
        $userRole = $_SESSION[SESSION_ROLE] ?? null;
        if (!$this->interceptor->intercept($requestPath, $userRole)) {
            exit;
        }

        list($class, $method) = $callback;
        $instance = new $class();

        call_user_func_array([$instance, $method], [
            array_merge($_GET, $_POST)
        ]);
    }
}
