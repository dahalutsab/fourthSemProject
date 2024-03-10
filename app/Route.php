<?php

namespace App;

class Route
{
    private string $path;
    private string $controllerMethod;
    private array $params;

    public function __construct(string $path, string $controllerMethod, array $params = [])
    {
        $this->path = $path;
        $this->controllerMethod = $controllerMethod;
        $this->params = $params;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): object
    {
        $controller = $this->getControllerName();
        return new $controller;
    }
    private function getControllerName(): string
    {
        $parts = explode('@', $this->controllerMethod);
        return $parts[0];
    }


    public function getMethod(): string
    {
        $parts = explode('@', $this->controllerMethod);
        return end($parts);
    }

    public function getParams(): array
    {
        return $this->params;
    }

}