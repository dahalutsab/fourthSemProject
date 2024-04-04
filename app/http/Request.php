<?php

namespace App\http;
class Request
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function input(string $key)
    {
        return $this->data[$key] ?? null;
    }
}