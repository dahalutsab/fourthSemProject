<?php
namespace config;

use AllowDynamicProperties;
use mysqli;

#[AllowDynamicProperties] class Database {

    private mysqli $connection;

    public function __construct() {
        $this->connect(new DatabaseConfig());
    }

    protected function connect(DatabaseConfig $config): void {
        $uri = "mysql://avnadmin:AVNS_VcooH8q6NlN_3ZrOsX_@open-mic-hub-open-mic-hub.e.aivencloud.com:10668/defaultdb?ssl-mode=REQUIRED";

        $fields = parse_url($uri);
        $host = $fields["host"];
        $port = $fields["port"];
        $user = $fields["user"];
        $pass = $fields["pass"];
        $dbname = ltrim($fields["path"], '/');

        $this->connection = new mysqli($host, $user, $pass, $dbname, $port);

        $this->connection->ssl_set(NULL, NULL, '/etc/ssl/certs/ca.pem', NULL, NULL);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $this->initializeDatabase(__DIR__ . '/open_mic_hub.sql');


    }

    public function getConnection(): mysqli {
        return $this->connection;
    }

    public function getInsertId(): int {
        return $this->getConnection()->insert_id;
    }


    public function initializeDatabase(string $sqlFilePath): void {
        $sql = file_get_contents($sqlFilePath);
        if ($sql === false) {
            die("Failed to read SQL file.");
        }

        if ($this->connection->multi_query($sql)) {
            do {
                if ($result = $this->connection->store_result()) {
                    $result->free();
                }
            } while ($this->connection->more_results() && $this->connection->next_result());
        } else {
            die("Error executing SQL: " . $this->connection->error);
        }
    }
}