<?php

namespace config;

use mysqli;
use mysqli_connect_error;
use mysqli_connect_errno;

class Database {

    private static ?Database $instance = null;
    private mysqli $conn;
    private string $servername = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $database = "open_mic_hub";

    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // Check connection
        if ($this->conn->connect_errno) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance(): Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }

    public function closeConnection(): void
    {
        $this->conn->close();
    }
}
