<?php

namespace App\repository\implementation;

use App\dto\request\ArtistDetailsRequest;
use App\models\ArtistDetails;
use App\repository\ArtistDetailsRepositoryInterface;
use config\Database;
use Exception;


class ArtistDetailsRepository implements ArtistDetailsRepositoryInterface
{
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(ArtistDetailsRequest $userProfileRequest): ArtistDetails
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


    private function insertUserProfile(ArtistDetailsRequest $userProfileRequest): void
    {
        $query = "INSERT INTO artist_details (user_id, full_name, stage_name, phone, address, category_id, bio, description) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $this->executeInsertQuery($query, $userProfileRequest);
    }

    private function executeInsertQuery($query, ArtistDetailsRequest $userProfileRequest): void
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

    private function updateUserProfile(ArtistDetailsRequest $userProfileRequest): void
    {
        $query = "UPDATE artist_details 
                  SET full_name=?, stage_name=?, phone=?, address=?, category_id=?, bio=?, description=?
                  WHERE user_id = ?";
        $this->executeUpdateQuery($query, $userProfileRequest);
    }

    private function executeUpdateQuery($query, ArtistDetailsRequest $userProfileRequest): void
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
    public function getUserProfile(string $userId): ?ArtistDetails
    {
        $query = "SELECT * FROM artist_details WHERE user_id = ?";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
        // Fetch the profile details
        $profile = $result->fetch_assoc();

        $userDetails = new ArtistDetails(
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

        // Return ArtistDetailsResponse object
        return $userDetails;
    }

    /**
     * @throws Exception
     */
    public function saveProfilePicture(string $profilePicture, int $userId): ?ArtistDetails
    {
        $query = "UPDATE artist_details 
                  SET profile_picture=?
                  WHERE user_id = ?";
        return$this->executeSaveProfilePictureQuery($query, $profilePicture, $userId);
    }

    /**
     * @throws Exception
     */
    private function executeSaveProfilePictureQuery(string $query, string $profilePicture, int $userId): ?ArtistDetails
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

}
