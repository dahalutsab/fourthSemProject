<?php
namespace migrations;

use config\Database;

class admin_insert
{
    public function up(): void
    {
//       if admin exists in the database, do not insert
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "SELECT * FROM users WHERE email = 'admin@gmail.com'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            return;
        }
        $hashedPassword = password_hash('Admin@123', PASSWORD_DEFAULT);
        $db = new Database();
        $connection = $db->getConnection();

        $sql = "INSERT INTO users (username, email, password, role_id, is_verified) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $password, $role_id, $is_verified);

        $username = 'admin';
        $email = 'admin@gmail.com';
        $password = $hashedPassword;
        $role_id = 1;
        $is_verified = 1;

        if (!$stmt->execute()) {
            echo "Error: " . $sql . "<br>" . $connection->error;
        } else
            echo "Admin inserted successfully";

        $stmt->close();
        $connection->close();
    }

    public function down(): void
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "DELETE FROM users WHERE email = 'admin@gmail.com'";
        if ($connection->query($sql) === TRUE) {
            echo "Admin deleted successfully";
        } else {
            echo "Error deleting admin: " . $connection->error;
        }
        $connection->close();
    }
}