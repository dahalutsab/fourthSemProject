<?php

namespace App\Service;

use App\dto\request\UserDetailsRequest;
use App\repository\implementation\UserDetailsRepository;
use Exception;

class UserDetailsService
{
    protected UserDetailsRepository $userProfileRepository;

    public function __construct()
    {
        $this->userProfileRepository = new UserDetailsRepository();
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(UserDetailsRequest $userProfileRequest)
    {
        try {
            // Call the repository method to save the user profile details
            $this->userProfileRepository->saveUserProfile($userProfileRequest);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving user profile: ' . $exception->getMessage());
        }
    }

    public function saveProfilePicture(string $picturePath)
    {
        try {
            // Call the repository method to save or update the profile picture path
            $this->userProfileRepository->saveProfilePicture($picturePath);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving profile picture: ' . $exception->getMessage());
        }
    }
}
