<?php
namespace App\Repository;

use Config\Database;

class UserRepository implements UserRepositoryInterface {
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function saveUser($username, $email, $password, $accountType): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $createdDate = date('Y-m-d H:i:s');

        $stmt = $this->database->getConnection()->prepare("INSERT INTO users (username, email, password, created_at) VALUES ( ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $createdDate);
        $stmt->execute();
        $stmt->close();
    }
}