<?php
namespace App\repository\implementation;

use App\models\User;
use App\Repository\UserRepositoryInterface;
use config\Database;



class UserRepository implements UserRepositoryInterface {
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function saveUser($username, $email, $password, $role): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $createdDate = date('Y-m-d H:i:s');

        $stmt = $this->database->getConnection()->prepare("INSERT INTO users (username, email, password, role_id, created_at) VALUES ( ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $username, $email, $hashedPassword, $role, $createdDate);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function getUserByEmail($email): ?User
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new User($row['id'], $row['username'], $row['email'], $row['password'], $row['role_id']);
        } else {
            return null;
        }
    }

    public function getUserId(string $email)
    {
        $stmt = $this->database->getConnection()->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return $row['id'];
        } else {
            return null;
        }
    }


}