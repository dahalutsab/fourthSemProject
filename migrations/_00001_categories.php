<?php

namespace migrations;

use config\Database;

class _00001_categories {
public function up(): void
{
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "CREATE TABLE categories (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            description VARCHAR(100) NOT NULL
        )";
        if ($connection->query($sql) === TRUE) {
            echo "Table categories created successfully";
        } else {
            echo "Error creating table: " . $connection->error;
        }
        $connection->close();
    }

    public function down(): void
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "DROP TABLE categories";
        if ($connection->query($sql) === TRUE) {
            echo "Table categories dropped successfully";
        } else {
            echo "Error dropping table: " . $connection->error;
        }
        $connection->close();
    }

}