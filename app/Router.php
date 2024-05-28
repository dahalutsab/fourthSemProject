<?php
declare(strict_types=1);

namespace app;

use app\interceptor\Interceptor;

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

    private function addHandler(string $method, string $path, array $handler, array $roles = [], string $redirectUrl = null): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
            'roles' => $roles,
            'redirectUrl' => $redirectUrl
        ];
    }

    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestPath = parse_url($requestUri, PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $params = [];

        foreach ($this->handlers as $handler) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $handler['path']);
            if (preg_match('#^' . $pattern . '$#', $requestPath, $matches) && $handler['method'] === $method) {
                $callback = $handler['handler'];
                $params = $matches;
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

        call_user_func_array([$instance, $method], [$params]);
    }
}
