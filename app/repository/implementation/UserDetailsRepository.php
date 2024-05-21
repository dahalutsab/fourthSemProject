<?php

namespace App\Repository\Implementation;

use App\DTO\Request\UserDetailsRequest;
use App\Models\UserDetails;
use App\Repository\UserDetailsRepositoryInterface;
use config\Database;
use Exception;
use mysqli_result;

class UserDetailsRepository implements UserDetailsRepositoryInterface
{
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(UserDetailsRequest $userDetails): UserDetails
    {
        try {
            // Check if the user ID exists
            $existingUserDetails = $this->getUserProfile($userDetails->getUserId());

            if ($existingUserDetails === null) {
                // User details don't exist, so insert them
                $this->insertUserProfile($userDetails);
            } else {
                // User details already exist, so update them
                $this->updateUserProfile($userDetails);
            }
            return $this->getUserProfile($userDetails->getUserId());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function insertUserProfile(UserDetailsRequest $userProfileRequest): void
    {
        $query = "INSERT INTO userdetails (user_id, fullName, phone, address, profilePicture, bio, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->executeInsertQuery($query, $userProfileRequest);
    }

    /**
     * @throws Exception
     */
    private function executeInsertQuery($query, UserDetailsRequest $userProfileRequest): void
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
        }

        $userId = $userProfileRequest->getUserId();
        $fullName = $userProfileRequest->getFullName();
        $phone = $userProfileRequest->getPhone();
        $address = $userProfileRequest->getAddress();
        $bio = $userProfileRequest->getBio();
        $profilePicture = null;
        $createdAt = date('Y-m-d H:i:s');

        $statement->bind_param("issssss", $userId, $fullName, $phone, $address, $profilePicture,  $bio, $createdAt);

        if (!$statement->execute()) {
            throw new Exception("Error executing statement: " . $statement->error);
        }

        $statement->close();
    }

    /**
     * @throws Exception
     */
    public function updateUserProfile(UserDetailsRequest $userDetails): UserDetails
    {
        $query = "UPDATE userdetails 
                  SET fullName=?, phone=?, address=?, bio=?, updated_at=?
                  WHERE user_id = ?";
        $this->executeUpdateQuery($query, $userDetails);
        return $this->getUserProfile($userDetails->getUserId());
    }

    /**
     * @throws Exception
     */
    private function executeUpdateQuery($query, UserDetailsRequest $userProfileRequest): void
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
        }

        $fullName = $userProfileRequest->getFullName();
        $phone = $userProfileRequest->getPhone();
        $address = $userProfileRequest->getAddress();
        $bio = $userProfileRequest->getBio();
        $updatedAt = date('Y-m-d H:i:s');
        $userId = $userProfileRequest->getUserId();

        $statement->bind_param("ssssis", $fullName, $phone, $address, $bio, $updatedAt, $userId);        if (!$statement->execute()) {
            throw new Exception("Error executing statement: " . $statement->error);
        }

        $statement->close();
    }

    /**
     * @throws Exception
     */
    public function getUserProfile(int $userId): ?UserDetails
    {
        $query = "SELECT * FROM userdetails WHERE user_id = ?";

        $result = $this->executeQuery($query, "i", $userId);
        if ($result->num_rows === 0) {
            return null;
        }
        // Fetch the profile details
        $profile = $result->fetch_assoc();

        // Return UserDetails object
        return new UserDetails(
            $profile['id'],
            $profile['fullName'] ?? null,
            $profile['phone'] ?? null,
            $profile['address'] ?? null,
            $profile['profilePicture'] ?? null,
            $profile['social_media'] ?? [],
            $profile['bio'] ?? null,
            $profile['created_at'] ?? null,
            $profile['updated_at'] ?? null
        );
    }


    /**
     * @throws Exception
     */
    public function saveProfilePicture(string $profilePicture, int $userId): ?UserDetails
    {
        $query = "UPDATE userdetails 
                  SET profilePicture=?
                  WHERE user_id = ?";
        return$this->executeSaveProfilePictureQuery($query, $profilePicture, $userId);
    }

    /**
     * @throws Exception
     */
    private function executeSaveProfilePictureQuery(string $query, string $profilePicture, int $userId): ?UserDetails
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
        }

        $statement->bind_param("si", $profilePicture, $userId);

        if (!$statement->execute()) {
            throw new Exception("Error executing statement: " . $statement->error);
        }
        return $this->getUserProfile($userId);
    }


    /**
     * @throws Exception
     */
    private function executeQuery(string $query, string $types, ...$params): ?mysqli_result
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
        }

        $statement->bind_param($types, ...$params);

        if (!$statement->execute()) {
            throw new Exception("Error executing statement: " . $statement->error);
        }

        $result = $statement->get_result();
        $statement->close();

        return $result;
    }

}
