<?php
namespace App\repository\implementation;

use App\dto\request\UserRequest;
use App\dto\response\UserResponse;
use App\models\User;
use App\Repository\UserRepositoryInterface;
use config\Database;


class UserRepository implements UserRepositoryInterface {
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function saveUser(UserRequest $userRequest): UserResponse
    {
        $hashedPassword = password_hash($userRequest->getPassword(), PASSWORD_DEFAULT);
        $createdDate = date('Y-m-d H:i:s');

        $username = $userRequest->getUsername();
        $email = $userRequest->getEmail();
        $role = $userRequest->getRole();

        $stmt = $this->database->getConnection()->prepare("INSERT INTO users (username, email, password, role_id, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $username, $email, $hashedPassword, $role, $createdDate);
        $stmt->execute();

        // Fetch the ID of the inserted user
        $id = $stmt->insert_id;

        $stmt->close();

        // Return a new UserResponse object with the inserted user data
        return new UserResponse($id, $username, $email, $role);
    }



    public function getUserByColumnValue($column, $value): ?User
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM users WHERE $column = ?");
        $stmt->bind_param("s", $value);
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