<?php
namespace config;

class DatabaseConfig {
    private string $host = 'open-mic-hub-open-mic-hub.f.aivencloud.com';
    private string $username = 'avnadmin';
    private string $password = 'AVNS_hbwIEeidNEY5AW-Z1iG';
    private string $database = 'defaultdb';
    private int $port = 10668;

    public function getHost(): string
    {
        return $this->host;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDatabase(): string
    {
        return $this->database;
    }

    public function getPort(): int
    {
        return $this->port;
    }
}