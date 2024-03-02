<?php

class Database {
    private string $host = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $dbname = "open_mic_hub";
    private string $charset = "utf8mb4";
    private PDO $connection;

    // Constructor to establish the database connection
    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage());
        }
    }

    // Execute a query with optional parameters
    public function query($sql, $params = []): false|PDOStatement
    {
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            throw new PDOException("Query execution failed: " . $e->getMessage());
        }
    }

    // Fetch all rows from a query result
    public function fetchAll($sql, $params = []): false|array
    {
        $statement = $this->query($sql, $params);
        return $statement->fetchAll();
    }

    // Fetch a single row from a query result
    public function fetch($sql, $params = []) {
        $statement = $this->query($sql, $params);
        return $statement->fetch();
    }

    // Get the last inserted ID
    public function lastInsertId(): false|string
    {
        return $this->connection->lastInsertId();
    }
}
