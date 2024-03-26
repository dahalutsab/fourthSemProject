<?php

namespace App\repository\implementation;

use App\dto\request\UserDetailsRequest;
use App\models\UserDetails;
use App\repository\UserDetailsRepositoryInterface;
use config\Database;
use Exception;


class UserDetailsRepository implements UserDetailsRepositoryInterface
{
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(UserDetailsRequest $userProfileRequest): UserDetails
    {
        try {
            // Check if the user ID exists
            $existingUserDetails = $this->getUserProfile($userProfileRequest->getUserId());

            if ($existingUserDetails == null) {
                // User details don't exist, so insert them
                $this->insertUserProfile($userProfileRequest);

            } else {
                // User details already exist, so update them
                $this->updateUserProfile($userProfileRequest);
            }
            return $this->getUserProfile($userProfileRequest->getUserId());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }


    private function insertUserProfile(UserDetailsRequest $userProfileRequest): void
    {
        $query = "INSERT INTO user_details (user_id, full_name, stage_name, phone, address, category_id, bio, description) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $this->executeInsertQuery($query, $userProfileRequest);
    }

    private function executeInsertQuery($query, UserDetailsRequest $userProfileRequest): void
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            $_SESSION['errors'][] = "Error preparing statement: " . $this->database->getConnection()->error;
            return;
        }

        $fullName = $userProfileRequest->getFullName();
        $stageName = $userProfileRequest->getStageName();
        $phone = $userProfileRequest->getPhone();
        $address = $userProfileRequest->getAddress();
        $categoryID = $userProfileRequest->getCategoryID();
        $bio = $userProfileRequest->getBio();
        $description = $userProfileRequest->getDescription();
        $userId = $userProfileRequest->getUserId();

        $statement->bind_param("isssssss", $userId, $fullName, $stageName, $phone, $address, $categoryID, $bio, $description);

        if (!$statement->execute()) {
            $_SESSION['errors'][] = "Error executing statement: " . $statement->error;
            return;
        }

        $statement->close();
    }

    private function updateUserProfile(UserDetailsRequest $userProfileRequest): void
    {
        $query = "UPDATE user_details 
                  SET full_name=?, stage_name=?, phone=?, address=?, category_id=?, bio=?, description=?
                  WHERE user_id = ?";
        $this->executeUpdateQuery($query, $userProfileRequest);
    }

    private function executeUpdateQuery($query, UserDetailsRequest $userProfileRequest): void
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            $_SESSION['errors'][] = "Error preparing statement: " . $this->database->getConnection()->error;
            return;
        }

        $fullName = $userProfileRequest->getFullName();
        $stageName = $userProfileRequest->getStageName();
        $phone = $userProfileRequest->getPhone();
        $address = $userProfileRequest->getAddress();
        $categoryID = $userProfileRequest->getCategoryID();
        $bio = $userProfileRequest->getBio();
        $description = $userProfileRequest->getDescription();
        $userId = $userProfileRequest->getUserId();

        $statement->bind_param("sssssssi", $fullName, $stageName, $phone, $address, $categoryID, $bio, $description, $userId);

        if (!$statement->execute()) {
            $_SESSION['errors'][] = "Error executing statement: " . $statement->error;
            return;
        }

        $statement->close();
    }

    /**
     * @throws Exception
     */
    public function getUserProfile(string $userId): ?UserDetails
    {
        $query = "SELECT * FROM user_details WHERE user_id = ?";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
        // Fetch the profile details
        $profile = $result->fetch_assoc();

        $userDetails = new UserDetails(
            $profile['id'],
            $profile['full_name'] ?? null,
            $profile['stage_name'] ?? null,
            $profile['phone'] ?? null,
            $profile['address'] ?? null,
            $profile['category_id'] ?? null,
            $profile['bio'] ?? null,
            $profile['description'] ?? null,
            $profile['social_media'] ?? null
        );

        $statement->close();

        // Return UserDetailsResponse object
        return $userDetails;
    }

}
