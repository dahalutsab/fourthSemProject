<?php
namespace Config;

class DatabaseConfig {
    private string $host = 'localhost';
    private string $username = 'root';
    private string $password = '';
    private string $database = 'open_mic_hub';


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
}
