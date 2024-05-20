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
            $existingUserDetails = $this->getUserProfile($userProfileRequest->getUserId());

            if ($existingUserDetails == null) {
                $this->insertUserProfile($userProfileRequest);
            } else {
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
        $this->executeQuery($query, $userProfileRequest);
    }

    private function updateUserProfile(ArtistDetailsRequest $userProfileRequest): void
    {
        $query = "UPDATE artist_details 
                  SET full_name=?, stage_name=?, phone=?, address=?, category_id=?, bio=?, description=?
                  WHERE user_id = ?";
        $this->executeQuery($query, $userProfileRequest);
    }

    private function executeQuery($query, ArtistDetailsRequest $userProfileRequest): void
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

        $isInsert = str_contains($query, 'INSERT');
        $params = $isInsert
            ? ["isssssss", $userId, $fullName, $stageName, $phone, $address, $categoryID, $bio, $description]
            : ["sssssssi", $fullName, $stageName, $phone, $address, $categoryID, $bio, $description, $userId];

        $statement->bind_param(...$params);

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
        $profile = $result->fetch_assoc();

        $userDetails = new ArtistDetails(
            $profile['id'],
            $profile['full_name'] ?? null,
            $profile['stage_name'] ?? null,
            $profile['phone'] ?? null,
            $profile['address'] ?? null,
            $profile['category_id'] ?? null,
            $profile['bio'] ?? null,
            $profile['profile_picture'] ?? null,
            $profile['description'] ?? null
        );

        $statement->close();

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
        $this->prepareAndExecuteStatement($query, $profilePicture, $userId);
        return $this->getUserProfile($userId);
    }

    /**
     * @throws Exception
     */
    private function prepareAndExecuteStatement(string $query, ...$params): void
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
        }

        $statement->bind_param("si", ...$params);

        if (!$statement->execute()) {
            throw new Exception("Error executing statement: " . $statement->error);
        }

    }

    public function getAllArtistsByCategory($id): array
    {
        $query = "SELECT * FROM artist_details WHERE category_id = $id";
        $result = $this->database->getConnection()->query($query);
        $singers = [];
        while ($row = $result->fetch_assoc()) {
            $singers[] = new ArtistDetails(
                $row['id'],
                $row['full_name'],
                $row['stage_name'],
                $row['phone'],
                $row['address'],
                $row['category_id'],
                $row['bio'],
                $row['profile_picture'],
                $row['description']
            );
        }
        return $singers;
    }
}