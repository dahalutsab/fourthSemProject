<?php

namespace App\repository\implementation;

use App\dto\request\UserDetailsRequest;
use App\dto\response\UserDetailsResponse;
use App\repository\UserDetailsRepositoryInterface;
use config\Database;
use Exception;
use RuntimeException;

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
    public function saveUserProfile(UserDetailsRequest $userProfileRequest)
    {
        try {
            $query = "INSERT INTO user_details (user_id, full_name, stage_name, phone, address, category_id, bio, description)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $statement = $this->database->getConnection()->prepare($query);
            if (!$statement) {
                $_SESSION['errors'][] = "Error preparing statement: " . $this->database->getConnection()->error;
                return false;
            }

            $fullName = $userProfileRequest->getFullName();
            $stageName = $userProfileRequest->getStageName();
            $phone = $userProfileRequest->getPhone();
            $address = $userProfileRequest->getAddress();
            $categoryID = $userProfileRequest->getCategoryID();
            $bio = $userProfileRequest->getBio();
            $description = $userProfileRequest->getDescription();
            $userId = $userProfileRequest->getUserId();

            $statement->bind_param("issssiss", $userId, $fullName, $stageName, $phone, $address, $categoryID, $bio, $description);

            if (!$statement->execute()) {
                $_SESSION['errors'][] = "Error executing statement: " . $statement->error;
                return false;
            }

            $statement->close();
            return true;
        } catch (Exception $exception) {
            $_SESSION['errors'][] = 'Error saving user profile: ' . $exception->getMessage();
            return false;
        }
    }


    public function saveProfilePicture(string $picturePath)
    {
        try {
            // Perform database operations to save or update the profile picture path
        } catch (Exception $exception) {
            $_SESSION['errors'][] = 'Error saving profile picture to the database: ' . $exception->getMessage();
        }
    }

    public function getUserProfile(string $userId): UserDetailsResponse
    {
        $query = "SELECT * FROM user_details WHERE user_id = ?";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();

        // Check if a row was returned
        if ($result->num_rows == 0) {
            // No user profile found, return an empty UserDetailsResponse
            return new UserDetailsResponse();
        }

        // Fetch the profile details
        $profile = $result->fetch_assoc();

        // Construct UserDetailsResponse object with null checks
        $userDetailsResponse = new UserDetailsResponse(
            $profile['id'] ?? null,
            $profile['full_name'] ?? null,
            $profile['stage_name'] ?? null,
            $profile['phone'] ?? null,
            $profile['address'] ?? null,
            $profile['category_id'] ?? null,
            $profile['bio'] ?? null,
            $profile['description'] ?? null
        );

        $statement->close();

        // Return UserDetailsResponse object
        return $userDetailsResponse;
    }


}
