<?php
namespace config;


use AllowDynamicProperties;
use mysqli;

#[AllowDynamicProperties] class Database {


    public function __construct() {
        $this->connect(new DatabaseConfig());
    }

    protected function connect(DatabaseConfig $config): void
    {
        $host = $config->getHost();
        $username = $config->getUsername();
        $password = $config->getPassword();
        $port = $config->getPort();
        $database = $config->getDatabase();

        $this->connection = new mysqli($host, $username, $password, $database, $port);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    public function getInsertId(): int {
        return $this->getConnection()->insert_id;
    }
}