<?php

class Database {
    private string $host = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $dbname = "open_mic_hub";
    private string $charset = "utf8mb4";

    public function connect(): PDO {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }

        return $this->pdo;
    }

    public function query(string $sql, array $params = []): PDOStatement {
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function fetchAll(string $sql, array $params = []): array {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchAssoc(string $sql, array $params = []): ?array {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchSingle(string $sql, array $params = []): string|int|null {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchColumn();
    }

    public function execute(string $sql, array $params = []): int {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
}
