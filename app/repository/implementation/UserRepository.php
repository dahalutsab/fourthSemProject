<?php
namespace App\Repository;

use Config\Database;

class UserRepository implements UserRepositoryInterface {
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function saveUser($username, $email, $password, $accountType): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $createdDate = date('Y-m-d H:i:s');

        $stmt = $this->database->getConnection()->prepare("INSERT INTO users (username, email, password, role_id, created_at) VALUES ( ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $username, $email, $hashedPassword, $accountType, $createdDate);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function getUserByEmail($email): ?object
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_object();
    }

}