<?php
namespace Config;

use Config\DatabaseConfig;

class Database {


    public function __construct() {
        $this->connect(new DatabaseConfig());
    }

    protected function connect(DatabaseConfig $config): void
    {
        $host = $config->getHost();
        $username = $config->getUsername();
        $password = $config->getPassword();
        $database = $config->getDatabase();

        $this->connection = new \mysqli($host, $username, $password, $database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection(): \mysqli
    {
        return $this->connection;
    }
}