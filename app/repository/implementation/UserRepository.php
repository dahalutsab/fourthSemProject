<?php
namespace app\repository\implementation;

use app\dto\request\UserRequest;
use app\models\User;
use app\repository\UserRepositoryInterface;
use config\Database;
use Exception;


class UserRepository implements UserRepositoryInterface {
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function saveUser(UserRequest $userRequest): User
    {
        $hashedPassword = password_hash($userRequest->getPassword(), PASSWORD_DEFAULT);
        $createdDate = date('Y-m-d H:i:s');

        $username = $userRequest->getUsername();
        $email = $userRequest->getEmail();
        $role = $userRequest->getRole();

        $stmt = $this->database->getConnection()->prepare("INSERT INTO users (username, email, password, role_id, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $username, $email, $hashedPassword, $role, $createdDate);
        $stmt->execute();

        // Fetch the ID of the inserted user
        $id = $stmt->insert_id;

        $stmt->close();
        return new User($id, $username, $email, $hashedPassword, $role, false, true, false);
    }



    public function getUserByColumnValue($column, $value): ?User
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM users WHERE $column = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new User($row['id'], $row['username'], $row['email'], $row['password'], $row['role_id'], $row['is_verified'], $row['is_active'], $row['is_blocked']);
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

    public function setUserVerificationTrue($userId): bool
    {
        $stmt = $this->database->getConnection()->prepare("UPDATE users SET is_verified = true WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    /**
     * @throws Exception
     */
    public function getUserById($userId): ?User
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new User($row['id'], $row['username'], $row['email'], $row['password'], $row['role_id'], $row['is_verified'], $row['is_active'], $row['is_blocked']);
        } else {
            throw new Exception("User not found");
        }
    }

    /**
     * @throws Exception
     */
    public function getUserRole($email)
    {
//        get role name of the user
        try {
            $stmt = $this->database->getConnection()->prepare("SELECT role_name FROM roles WHERE role_id = (SELECT role_id FROM users WHERE email = ?)");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                return $row['role_name'];
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw new Exception("Error getting user role");
        }

    }

    public function getAllUsers(): array
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM users");
        $stmt->execute();

        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = new User($row['id'], $row['username'], $row['email'], $row['password'], $row['role_id'], $row['is_verified'], $row['is_active'], $row['is_blocked']);
        }
        return $users;
    }

    public function resetPassword(mixed $userId, mixed $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->database->getConnection()->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function getNavbarDetails($userId): ?array
    {
//        get username from users and profile picture from userdetails if role is user and artistdetails if role is artist
        $stmt = $this->database->getConnection()->prepare("SELECT username, role_id FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $username = $row['username'];
            $role = $row['role_id'];
            if ($role == 1) {
                $stmt = $this->database->getConnection()->prepare("SELECT profilePicture FROM userdetails WHERE user_id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();

                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row) {
                    $imagePath = $row['profile_picture'];
                } else {
                    $imagePath = null;
                }
            } else {
                $stmt = $this->database->getConnection()->prepare("SELECT profile_picture FROM artist_details WHERE user_id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();

                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row) {
                    $imagePath = $row['profile_picture'];
                } else {
                    $imagePath = null;
                }
            }

            $stmt = $this->database->getConnection()->prepare("SELECT role_name FROM roles WHERE role_id = ?");
            $stmt->bind_param("i", $role);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $role = $row['role_name'];
            return [
                'imagePath' => $imagePath,
                'username' => $username,
                'role' => $role
            ];
        } else {
            return null;
        }
    }

    /**
     * @throws Exception
     */
    public function changePassword($data): true
    {
        $userId = $_SESSION[SESSION_USER_ID];
        $stmt = $this->database->getConnection()->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if (password_verify($data['oldPassword'], $row['password'])) {
                $hashedPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                $stmt = $this->database->getConnection()->prepare("UPDATE users SET password = ?, updated_at = ? WHERE id = ?");
                $date = date('Y-m-d H:i:s');
                $stmt->bind_param("ssi", $hashedPassword, $date, $userId);
                $stmt->execute();
                return true;
            } else {
                throw new Exception("Old password is incorrect");
            }
        } else {
            throw new Exception("User not found");
        }
    }

    public function blockUser($userId): true
    {
        $stmt = $this->database->getConnection()->prepare("UPDATE users SET is_blocked = true WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return true;
    }
}