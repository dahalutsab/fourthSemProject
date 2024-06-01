<?php
namespace config;

class DatabaseConfig {
    private string $host = 'fdb1032.awardspace.net';
    private string $username = '4489259_openmichub';
    private string $password = 'sY6gt4KH4#-gwvf';
    private string $database = '4489259_openmichub';


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
