<?php
declare(strict_types=1);

namespace App;

class Router
{
    private array $handler;
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function get($path, $handler, $redirectUrl = null): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler, $redirectUrl);
    }

    public function post($path, $handler, $redirectUrl = null): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler, $redirectUrl);
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler($method, $path, $handler, $redirectUrl): void
    {
        $this->handler[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
            'redirectUrl' => $redirectUrl
        ];
    }

    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestPath = parse_url($requestUri, PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $redirectUrl = null;
        foreach ($this->handler as $handler) {
            if ($handler['path'] === $requestPath && $handler['method'] === $method) {
                $callback = $handler['handler'];
                $redirectUrl = $handler['redirectUrl']; // Get the redirect URL
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

        if ($redirectUrl && !$this->isUserAuthenticated()) {
            // Redirect to the URL specified in the route
            header('Location: ' . $redirectUrl);
            exit;
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }

    private function isUserAuthenticated(): bool
    {
        return isset($_SESSION[SESSION_USER_ID]) || isset($_SESSION[SESSION_EMAIL]);
    }
}
