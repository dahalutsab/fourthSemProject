<?php

namespace App\repository\implementation;

use App\dto\request\UserDetailsRequest;
use App\repository\UserDetailsRepositoryInterface;
use Exception;


class UserDetailsRepository implements UserDetailsRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function saveUserProfile(UserDetailsRequest $userProfileRequest)
    {
        try {
            $query = "INSERT INTO user_details (full_name, stage_name, phone, address, talent_type, bio, description)
                      VALUES (:fullName, :stageName, :phone, :address, :talentType, :bio, :description)";

            $statement = $this->connection->prepare($query);

            $statement->bindValue(':fullName', $userProfileRequest->getFullName());
            $statement->bindValue(':stageName', $userProfileRequest->getStageName());
            $statement->bindValue(':phone', $userProfileRequest->getPhone());
            $statement->bindValue(':address', $userProfileRequest->getAddress());
            $statement->bindValue(':talentType', $userProfileRequest->getTalentType());
            $statement->bindValue(':bio', $userProfileRequest->getBio());
            $statement->bindValue(':description', $userProfileRequest->getDescription());

            $statement->execute();
        } catch (Exception $exception) {
            throw new Exception('Error saving user profile: ' . $exception->getMessage());
        }
    }

    public function saveProfilePicture(string $picturePath)
    {
        try {
            // Perform database operations to save or update the profile picture path
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving profile picture to the database: ' . $exception->getMessage());
        }
    }

}